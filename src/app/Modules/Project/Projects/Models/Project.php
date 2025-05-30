<?php

namespace App\Modules\Project\Projects\Models;

use App\Modules\Authentication\Models\User;
use App\Modules\Project\Accomodations\Models\Accomodation;
use App\Modules\Project\AdditionalContents\Models\AdditionalContent;
use App\Modules\Project\Banners\Models\Banner;
use App\Modules\Project\CommonAmenitys\Models\CommonAmenity;
use App\Modules\Project\GalleryImages\Models\GalleryImage;
use App\Modules\Project\GalleryVideos\Models\GalleryVideo;
use App\Modules\Project\PlanCategory\Models\PlanCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;

class Project extends Model implements Sitemapable
{
    use HasFactory, LogsActivity;

    protected $table = 'projects';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'location',
        'floor',
        'acre',
        'tower',
        'rera',
        'brief_description',
        'description',
        'description_unfiltered',
        'address',
        'map_location_link',
        'brochure',
        'brochure_bg_image',
        'video',
        'use_in_banner',
        'use_in_home',
        'home_image',
        'position',
        'is_draft',
        'is_completed',
        'page_keywords',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_header_script',
        'meta_footer_script',
        'meta_header_no_script',
        'meta_footer_no_script',
        'srd_code',
        'projectId',
    ];

    protected $casts = [
        'is_draft' => 'boolean',
        'is_completed' => 'boolean',
        'use_in_banner' => 'boolean',
        'use_in_home' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public $brochure_path = 'projects';
    public $brochure_bg_image_path = 'projects';
    public $home_image_path = 'projects';

    protected $appends = ['brochure_link', 'brochure_bg_image_link', 'home_image_link', 'meta_header_script_nonce', 'meta_footer_script_nonce', 'meta_header_no_script_nonce', 'meta_footer_no_script_nonce', 'video_id'];

    protected function brochure(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => 'storage/'.$this->brochure_path.'/'.$value,
        );
    }

    protected function brochureLink(): Attribute
    {
        return new Attribute(
            get: fn () => asset($this->brochure),
        );
    }

    protected function brochureBgImage(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => 'storage/'.$this->brochure_bg_image_path.'/'.$value,
        );
    }

    protected function brochureBgImageLink(): Attribute
    {
        return new Attribute(
            get: fn () => asset($this->brochure_bg_image),
        );
    }

    protected function homeImage(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => 'storage/'.$this->home_image_path.'/'.$value,
        );
    }

    protected function homeImageLink(): Attribute
    {
        return new Attribute(
            get: fn () => asset($this->home_image),
        );
    }

    protected function videoId(): Attribute
    {
        return new Attribute(
            get: fn () => $this->getVideoId(),
        );
    }

    public function getVideoId(){
        if($this->video){
            $video_id = explode("/embed/", $this->video);
            if(count($video_id) > 1){
                $video_id = $video_id[1];
                return $video_id;
            }
        }
        return null;
    }

    protected function slug(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => str()->slug($value),
        );
    }

    protected function metaHeaderScriptNonce(): Attribute
    {
        return new Attribute(
            get: fn () => str_replace("<script","<script nonce='".csp_nonce()."'",$this->meta_header_script),
        );
    }

    protected function metaHeaderNoScriptNonce(): Attribute
    {
        return new Attribute(
            get: fn () => str_replace("<noscript","<noscript nonce='".csp_nonce()."'",$this->meta_header_no_script),
        );
    }

    protected function metaFooterScriptNonce(): Attribute
    {
        return new Attribute(
            get: fn () => str_replace("<script","<script nonce='".csp_nonce()."'",$this->meta_footer_script),
        );
    }

    protected function metaFooterNoScriptNonce(): Attribute
    {
        return new Attribute(
            get: fn () => str_replace("<noscript","<noscript nonce='".csp_nonce()."'",$this->meta_footer_no_script),
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    public function banner()
    {
        return $this->hasMany(Banner::class, 'project_id');
    }

    public function gallery_image()
    {
        return $this->hasMany(GalleryImage::class, 'project_id');
    }

    public function gallery_video()
    {
        return $this->hasMany(GalleryVideo::class, 'project_id');
    }

    public function plan_category()
    {
        return $this->hasMany(PlanCategory::class, 'project_id');
    }

    public function amenity()
    {
        return $this->belongsToMany(CommonAmenity::class, 'project_amenities', 'project_id', 'amenity_id');
    }

    public function additional_content()
    {
        return $this->hasMany(AdditionalContent::class, 'project_id');
    }

    public function accomodation()
    {
        return $this->hasMany(Accomodation::class, 'project_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('projects')
        ->setDescriptionForEvent(
                function(string $eventName){
                    $desc = "Project with name ".$this->name." has been {$eventName}";
                    $desc .= auth()->user() ? " by ".auth()->user()->name."<".auth()->user()->email.">" : "";
                    return $desc;
                }
            )
        ->logFillable()
        ->logOnlyDirty();
        // Chain fluent methods for configuration options
    }

    public function toSitemapTag(): Url | string | array
    {
        return route($this->is_completed==true ? 'completed_projects_detail.get' : 'ongoing_projects_detail.get', $this->slug);
    }
}
