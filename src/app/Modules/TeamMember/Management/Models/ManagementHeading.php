<?php

namespace App\Modules\TeamMember\Management\Models;

use App\Modules\Authentication\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ManagementHeading extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'team_member_management_headings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'heading',
        'sub_heading',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();
        self::created(function ($model) {
            Cache::forget('team_member_management_heading_main_'.$model->id);
        });
        self::updated(function ($model) {
            Cache::forget('team_member_management_heading_main_'.$model->id);
        });
        self::deleted(function ($model) {
            Cache::forget('team_member_management_heading_main_'.$model->id);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('team member management heading section')
        ->setDescriptionForEvent(
                function(string $eventName){
                    $desc = "Team member management heading detail has been {$eventName}";
                    $desc .= auth()->user() ? " by ".auth()->user()->name."<".auth()->user()->email.">" : "";
                    return $desc;
                }
            )
        ->logFillable()
        ->logOnlyDirty();
        // Chain fluent methods for configuration options
    }
}
