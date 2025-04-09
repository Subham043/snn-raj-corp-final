<?php

namespace App\Modules\About\AdditionalContent\Models;

use App\Modules\Authentication\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Cache;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class AdditionalContent extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'about_contents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'heading',
        'button_text',
        'button_link',
        'description',
        'description_unfiltered',
        'image',
        'is_draft',
        'activate_popup',
        'popup_button_slug',
        'popup_button_text',
        'popup_description',
        'popup_description_unfiltered',
    ];

    protected $casts = [
        'is_draft' => 'boolean',
        'activate_popup' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public $image_path = 'about_contents';

    protected $appends = ['image_link'];

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

    protected function popupButtonSlug(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => !empty($value) ? str()->slug($value) : null,
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('about additional content section')
        ->setDescriptionForEvent(
            function(string $eventName){
                $desc = "Additional content with heading ".$this->heading." has been {$eventName}";
                $desc .= auth()->user() ? " by ".auth()->user()->name."<".auth()->user()->email.">" : "";
                return $desc;
            }
            )
        ->logFillable()
        ->logOnlyDirty();
        // Chain fluent methods for configuration options
    }
}
