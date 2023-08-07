<?php

namespace App\Modules\Enquiry\PopupForm\Models;

use App\Modules\Project\Projects\Models\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class PopupForm extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'popup_form_enquiries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'country_code',
        'project',
        'project_id',
        'subject',
        'message',
        'page_url',
        'ip_address',
        'otp',
        'is_verified',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'is_verified' => 'boolean',
    ];

    public function project_detail()
    {
        return $this->belongsTo(Project::class, 'project_id')->withDefault();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('popup form enquiries')
        ->setDescriptionForEvent(
                function(string $eventName){
                    $desc = "Popup form enquiry with user name ".$this->name." has been {$eventName}";
                    $desc .= auth()->user() ? " by ".auth()->user()->name."<".auth()->user()->email.">" : "";
                    return $desc;
                }
            )
        ->logFillable()
        ->logOnlyDirty();
        // Chain fluent methods for configuration options
    }
}
