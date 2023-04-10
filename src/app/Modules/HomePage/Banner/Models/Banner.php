<?php

namespace App\Modules\HomePage\Banner\Models;

use App\Modules\Authentication\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

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
        'is_banner_image',
        'banner_image',
        'banner_image_alt',
        'banner_image_title',
        'banner_video',
        'banner_video_title',
        'is_draft'
    ];

    protected $casts = [
        'is_banner_image' => 'boolean',
        'is_draft' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public $image_path = 'home_page_banners';

    protected $appends = ['banner_image_link'];

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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('user')
        ->setDescriptionForEvent(
            fn(string $eventName) => "This banner with title ".$this->title." has been {$eventName} by ".auth()->user()->name."<".auth()->user()->email.">"
            )
        ->logFillable()
        ->logOnlyDirty();
        // Chain fluent methods for configuration options
    }
}
