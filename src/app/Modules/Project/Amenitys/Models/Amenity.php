<?php

namespace App\Modules\Project\Amenitys\Models;

use App\Modules\Authentication\Models\User;
use App\Modules\Project\CommonAmenitys\Models\CommonAmenity;
use App\Modules\Project\Projects\Models\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Amenity extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'project_amenities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'project_id',
        'amenity_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id')->withDefault();
    }

    public function amenity()
    {
        return $this->belongsTo(CommonAmenity::class, 'amenity_id')->withDefault();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->useLogName('project amenities')
        ->setDescriptionForEvent(
                function(string $eventName){
                    $desc = "Project Amenity has been {$eventName}";
                    $desc .= auth()->user() ? " by ".auth()->user()->name."<".auth()->user()->email.">" : "";
                    return $desc;
                }
            )
        ->logFillable()
        ->logOnlyDirty();
        // Chain fluent methods for configuration options
    }
}
