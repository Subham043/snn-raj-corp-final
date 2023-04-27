<?php

namespace App\Modules\Project\GalleryVideos\Models;

use App\Modules\Authentication\Models\User;
use App\Modules\Project\Projects\Models\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Casts\Attribute;

class GalleryVideo extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'project_gallery_videos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'video',
        'video_title',
        'is_draft'
    ];

    protected $casts = [
        'is_draft' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = ['video_id'];

    protected function videoId(): Attribute
    {
        return new Attribute(
            get: fn () => $this->getBannerVideoId(),
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id')->withDefault();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('project gallery videos')
        ->setDescriptionForEvent(
                function(string $eventName){
                    $desc = "Project Gallery Video has been {$eventName}";
                    $desc .= auth()->user() ? " by ".auth()->user()->name."<".auth()->user()->email.">" : "";
                    return $desc;
                }
            )
        ->logFillable()
        ->logOnlyDirty();
        // Chain fluent methods for configuration options
    }

    public function getBannerVideoId(){
        if($this->video){
            $video_id = explode("/embed/", $this->video);
            if(count($video_id) > 1){
                $video_id = $video_id[1];
                return $video_id;
            }
        }
        return null;
    }
}
