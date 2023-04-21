<?php

namespace App\Modules\HomePage\Banner\Models;

use App\Modules\Authentication\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Cache;

class Banner extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'home_page_banners';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'button_link',
        'banner_image',
        'banner_image_alt',
        'banner_image_title',
        'banner_video',
        'banner_video_title',
        'is_draft'
    ];

    protected $casts = [
        'is_draft' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public $image_path = 'home_page_banners';

    protected $appends = ['banner_image_link', 'banner_video_id'];

    public static function boot()
    {
        parent::boot();
        self::created(function ($model) {
            Cache::forget('home_page_banners_main');
        });
        self::updated(function ($model) {
            Cache::forget('home_page_banners_main');
        });
        self::deleted(function ($model) {
            Cache::forget('home_page_banners_main');
        });
    }

    protected function bannerImage(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => 'storage/'.$this->image_path.'/'.$value,
        );
    }

    protected function bannerImageLink(): Attribute
    {
        return new Attribute(
            get: fn () => asset($this->banner_image),
        );
    }

    protected function bannerVideoId(): Attribute
    {
        return new Attribute(
            get: fn () => $this->getBannerVideoId(),
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('home page banner')
        ->setDescriptionForEvent(
                function(string $eventName){
                    $desc = "Home page banner with title ".$this->title." has been {$eventName}";
                    $desc .= auth()->user() ? " by ".auth()->user()->name."<".auth()->user()->email.">" : "";
                    return $desc;
                }
            )
        ->logFillable()
        ->logOnlyDirty();
        // Chain fluent methods for configuration options
    }

    public function getBannerVideoId(){
        if($this->banner_video){
            $video_id = explode("/embed/", $this->banner_video);
            $video_id = $video_id[1];
            return $video_id;
        }
        return null;
    }

}
