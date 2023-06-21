<?php

namespace App\Modules\Enquiry\EmpanelmentForm\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Casts\Attribute;

class EmpanelmentForm extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'empanelment_forms';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'scope',
        'channel_partner',
        'address',
        'phone',
        'telephone',
        'email',
        'rera',
        'contact_person_name',
        'designation',
        'pan',
        'gst',
        'sac',
        'tax',
        'bank_name',
        'bank_address',
        'bank_branch',
        'bank_account_number',
        'ifsc',
        'ip_address',
        'msme',
        'msme_image',
        'esi',
        'epf',
        'pan_image',
        'gst_image',
        'seal_image',
        'cheque_image',
        'rera_image',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'msme' => 'boolean',
        'esi' => 'boolean',
        'epf' => 'boolean',
    ];

    public $file_path = 'empanelment_forms';

    protected $appends = ['msme_image_link', 'pan_image_link', 'gst_image_link', 'cheque_image_link', 'rera_image_link'];

    protected function msmeImage(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => 'storage/'.$this->file_path.'/'.$value,
        );
    }

    protected function msmeImageLink(): Attribute
    {
        return new Attribute(
            get: fn () => asset($this->msme_image),
        );
    }

    protected function panImage(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => 'storage/'.$this->file_path.'/'.$value,
        );
    }

    protected function panImageLink(): Attribute
    {
        return new Attribute(
            get: fn () => asset($this->pan_image),
        );
    }

    protected function gstImage(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => 'storage/'.$this->file_path.'/'.$value,
        );
    }

    protected function gstImageLink(): Attribute
    {
        return new Attribute(
            get: fn () => asset($this->gst_image),
        );
    }

    protected function chequeImage(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => 'storage/'.$this->file_path.'/'.$value,
        );
    }

    protected function chequeImageLink(): Attribute
    {
        return new Attribute(
            get: fn () => asset($this->cheque_image),
        );
    }

    protected function reraImage(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => 'storage/'.$this->file_path.'/'.$value,
        );
    }

    protected function reraImageLink(): Attribute
    {
        return new Attribute(
            get: fn () => asset($this->rera_image),
        );
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('career form enquiries')
        ->setDescriptionForEvent(
                function(string $eventName){
                    $desc = "Empanelment form enquiry with user name ".$this->contact_person_name." has been {$eventName}";
                    $desc .= auth()->user() ? " by ".auth()->user()->name."<".auth()->user()->email.">" : "";
                    return $desc;
                }
            )
        ->logFillable()
        ->logOnlyDirty();
        // Chain fluent methods for configuration options
    }
}
