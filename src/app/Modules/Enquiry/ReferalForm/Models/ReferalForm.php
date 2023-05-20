<?php

namespace App\Modules\Enquiry\ReferalForm\Models;

use App\Modules\Project\Projects\Models\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ReferalForm extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'referal_enquiries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'member_name',
        'member_email',
        'member_phone',
        'member_unit',
        'member_project_id',
        'referal_name',
        'referal_email',
        'referal_phone',
        'referal_relation',
        'referal_project_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function member_project()
    {
        return $this->belongsTo(Project::class, 'member_project_id')->withDefault();
    }

    public function referal_project()
    {
        return $this->belongsTo(Project::class, 'referal_project_id')->withDefault();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('contact form enquiries')
        ->setDescriptionForEvent(
                function(string $eventName){
                    $desc = "Referal form enquiry with user name ".$this->name." has been {$eventName}";
                    $desc .= auth()->user() ? " by ".auth()->user()->name."<".auth()->user()->email.">" : "";
                    return $desc;
                }
            )
        ->logFillable()
        ->logOnlyDirty();
        // Chain fluent methods for configuration options
    }
}
