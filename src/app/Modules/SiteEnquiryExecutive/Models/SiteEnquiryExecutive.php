<?php

namespace App\Modules\SiteEnquiryExecutive\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Hash;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


class SiteEnquiryExecutive extends Authenticatable
{
    use LogsActivity;

    protected $table = 'site_enquiry_executives';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    //only the `deleted` event will get logged automatically
    protected static $recordEvents = ['created', 'updated', 'deleted'];


    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Hash::make($value),
        );
    }

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
