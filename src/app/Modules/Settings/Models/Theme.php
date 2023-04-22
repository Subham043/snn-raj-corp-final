<?php

namespace App\Modules\Settings\Models;

use App\Modules\Authentication\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Cache;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Theme extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'general_theme_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'background_color',
        'primary_color',
        'overlay_color',
        'lines_color',
        'text_color',
        'highlight_text_color',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();
        self::created(function ($model) {
            Cache::forget('theme_settings_main_'.$model->id);
        });
        self::updated(function ($model) {
            Cache::forget('theme_settings_main_'.$model->id);
        });
        self::deleted(function ($model) {
            Cache::forget('theme_settings_main_'.$model->id);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('theme settings')
        ->setDescriptionForEvent(
            function(string $eventName){
                $desc = "Website theme settings has been {$eventName}";
                $desc .= auth()->user() ? " by ".auth()->user()->name."<".auth()->user()->email.">" : "";
                return $desc;
            }
            )
        ->logFillable()
        ->logOnlyDirty();
        // Chain fluent methods for configuration options
    }
}
