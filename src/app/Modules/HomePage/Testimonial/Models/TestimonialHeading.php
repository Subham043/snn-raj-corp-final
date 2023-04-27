<?php

namespace App\Modules\HomePage\Testimonial\Models;

use App\Modules\Authentication\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class TestimonialHeading extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'testimonial_headings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'heading',
        'sub_heading',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();
        self::created(function ($model) {
            Cache::forget('testimonial_heading_'.$model->id);
        });
        self::updated(function ($model) {
            Cache::forget('testimonial_heading_'.$model->id);
        });
        self::deleted(function ($model) {
            Cache::forget('testimonial_heading_'.$model->id);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('testimonial heading section')
        ->setDescriptionForEvent(
                function(string $eventName){
                    $desc = "Testimonial heading detail has been {$eventName}";
                    $desc .= auth()->user() ? " by ".auth()->user()->name."<".auth()->user()->email.">" : "";
                    return $desc;
                }
            )
        ->logFillable()
        ->logOnlyDirty();
        // Chain fluent methods for configuration options
    }
}
