<?php

namespace App\Modules\Enquiry\CareerForm\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Casts\Attribute;

class CareerForm extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'careers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'experience',
        'description',
        'cv',
        'ip_address',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public $cv_path = 'careers';

    protected $appends = ['cv_link'];

    protected function cv(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => 'storage/'.$this->cv_path.'/'.$value,
        );
    }

    protected function cvLink(): Attribute
    {
        return new Attribute(
            get: fn () => asset($this->cv),
        );
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('career form enquiries')
        ->setDescriptionForEvent(
                function(string $eventName){
                    $desc = "Career form enquiry with user name ".$this->name." has been {$eventName}";
                    $desc .= auth()->user() ? " by ".auth()->user()->name."<".auth()->user()->email.">" : "";
                    return $desc;
                }
            )
        ->logFillable()
        ->logOnlyDirty();
        // Chain fluent methods for configuration options
    }
}
