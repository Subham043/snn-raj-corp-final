<?php

namespace App\Modules\Seo\Models;

use App\Modules\Authentication\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Cache;

class Seo extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'seos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'page_name',
        'slug',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_header_script',
        'meta_footer_script',
        'meta_header_no_script',
        'meta_footer_no_script',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = ['meta_header_script_nonce', 'meta_footer_script_nonce', 'meta_header_no_script_nonce', 'meta_footer_no_script_nonce'];

    public static function boot()
    {
        parent::boot();
        self::created(function ($model) {
            Cache::forget('seo_'.$model->slug);
        });
        self::updated(function ($model) {
            Cache::forget('seo_'.$model->slug);
        });
        self::deleted(function ($model) {
            Cache::forget('seo_'.$model->slug);
        });
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

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('seo')
        ->setDescriptionForEvent(
                function(string $eventName){
                    $desc = "Seo with page name ".$this->page_name." has been {$eventName}";
                    $desc .= auth()->user() ? " by ".auth()->user()->name."<".auth()->user()->email.">" : "";
                    return $desc;
                }
            )
        ->logFillable()
        ->logOnlyDirty();
        // Chain fluent methods for configuration options
    }
}
