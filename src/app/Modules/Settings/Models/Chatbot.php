<?php

namespace App\Modules\Settings\Models;

use App\Modules\Authentication\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Cache;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Chatbot extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'general_chatbot_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'chatbot_script'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = ['chatbot_script_nonce'];

    public static function boot()
    {
        parent::boot();
        self::created(function ($model) {
            Cache::forget('chatbot_settings_main_'.$model->id);
        });
        self::updated(function ($model) {
            Cache::forget('chatbot_settings_main_'.$model->id);
        });
        self::deleted(function ($model) {
            Cache::forget('chatbot_settings_main_'.$model->id);
        });
    }

    protected function chatbotScriptNonce(): Attribute
    {
        return new Attribute(
            get: fn () => str_replace("<script","<script nonce='".csp_nonce()."'",$this->chatbot_script),
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('chatbot settings')
        ->setDescriptionForEvent(
            function(string $eventName){
                $desc = "Website chatbot settings has been {$eventName}";
                $desc .= auth()->user() ? " by ".auth()->user()->name."<".auth()->user()->email.">" : "";
                return $desc;
            }
            )
        ->logFillable()
        ->logOnlyDirty();
        // Chain fluent methods for configuration options
    }
}
