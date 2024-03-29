<?php

namespace App\Modules\HomePage\About\Models;

use App\Modules\Authentication\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Cache;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class About extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'home_page_abouts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'heading',
        'sub_heading',
        'description',
        'description_unfiltered',
        'image',
        'video',
        'use_in_banner',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'use_in_banner' => 'boolean',
    ];

    public $image_path = 'home_page_abouts';

    protected $appends = ['image_link', 'video_id'];

    protected function image(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => 'storage/'.$this->image_path.'/'.$value,
        );
    }

    protected function imageLink(): Attribute
    {
        return new Attribute(
            get: fn () => asset($this->image),
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('home page about section')
        ->setDescriptionForEvent(
                function(string $eventName){
                    $desc = "Home page about detail has been {$eventName}";
                    $desc .= auth()->user() ? " by ".auth()->user()->name."<".auth()->user()->email.">" : "";
                    return $desc;
                }
            )
        ->logFillable()
        ->logOnlyDirty();
        // Chain fluent methods for configuration options
    }
}
