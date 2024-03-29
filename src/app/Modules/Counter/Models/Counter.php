<?php

namespace App\Modules\Counter\Models;

use App\Modules\Authentication\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Cache;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Counter extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'counters';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'counter',
        'is_draft'
    ];

    protected $casts = [
        'is_draft' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $appends = ['counter_number', 'counter_text'];

    protected function counterNumber(): Attribute
    {
        return new Attribute(
            get: fn () => preg_replace('/[^0-9]/', '', $this->counter),
        );
    }

    protected function counterText(): Attribute
    {
        return new Attribute(
            get: fn () => preg_replace('/[^a-zA-Z\@\-\/\(\)\\\#\;\[\]\{\}\$\+\.\-]/', '', $this->counter),
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('counters')
        ->setDescriptionForEvent(
                function(string $eventName){
                    $desc = "Counter with title ".$this->title." has been {$eventName}";
                    $desc .= auth()->user() ? " by ".auth()->user()->name."<".auth()->user()->email.">" : "";
                    return $desc;
                }
            )
        ->logFillable()
        ->logOnlyDirty();
        // Chain fluent methods for configuration options
    }
}
