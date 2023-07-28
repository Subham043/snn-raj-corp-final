<?php

namespace App\Modules\HomePage\Testimonial\Models;

use App\Modules\Authentication\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Cache;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Testimonial extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'home_page_testimonials';

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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('home page testimonial')
        ->setDescriptionForEvent(
                function(string $eventName){
                    $desc = "Testimonial has been {$eventName}";
                    $desc .= auth()->user() ? " by ".auth()->user()->name."<".auth()->user()->email.">" : "";
                    return $desc;
                }
            )
        ->logFillable()
        ->logOnlyDirty();
        // Chain fluent methods for configuration options
    }
}
