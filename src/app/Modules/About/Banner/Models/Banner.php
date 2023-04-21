<?php

namespace App\Modules\About\Banner\Models;

use App\Modules\Authentication\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Cache;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Banner extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'about_banners';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'heading',
        'mission',
        'vission',
        'button_text',
        'button_link',
        'description',
        'image',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public $image_path = 'about_banners';

    protected $appends = ['image_link'];

    public static function boot()
    {
        parent::boot();
        self::created(function ($model) {
            Cache::forget('about_page_banner_main_'.$model->id);
        });
        self::updated(function ($model) {
            Cache::forget('about_page_banner_main_'.$model->id);
        });
        self::deleted(function ($model) {
            Cache::forget('about_page_banner_main_'.$model->id);
        });
    }

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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('about banner section')
        ->setDescriptionForEvent(
            function(string $eventName){
                $desc = "About page banner detail has been {$eventName}";
                $desc .= auth()->user() ? " by ".auth()->user()->name."<".auth()->user()->email.">" : "";
                return $desc;
            }
            )
        ->logFillable()
        ->logOnlyDirty();
        // Chain fluent methods for configuration options
    }
}
