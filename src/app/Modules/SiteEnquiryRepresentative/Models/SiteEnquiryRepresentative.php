<?php

namespace App\Modules\SiteEnquiryRepresentative\Models;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;


class SiteEnquiryRepresentative extends Model
{
    use LogsActivity;

    protected $table = 'site_enquiry_representatives';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'paramantra_code',
    ];


    //only the `deleted` event will get logged automatically
    protected static $recordEvents = ['created', 'updated', 'deleted'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('site_enquiry_executive')
        ->setDescriptionForEvent(
                function(string $eventName){
                    $desc = $this->name."<".$this->email."> has been {$eventName}";
                    $desc .= auth()->user() ? " by ".auth()->user()->name."<".auth()->user()->email.">" : "";
                    return $desc;
                }
            )
        ->logOnly(['name', 'email'])
        ->logOnlyDirty();
        // ->logFillable();
        // Chain fluent methods for configuration options
    }

}