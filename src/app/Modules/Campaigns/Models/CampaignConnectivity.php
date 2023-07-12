<?php

namespace App\Modules\Campaigns\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class CampaignConnectivity extends Model
{
    use HasFactory;

    protected $table = 'campaign_connectivity_sections';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'points',
        'campaign_id',
    ];

    protected $appends = ['points_list'];

    protected function pointsList(): Attribute
    {
        return new Attribute(
            get: fn () => explode("|",$this->points),
        );
    }

    public function Campaign()
    {
        return $this->belongsTo('App\Modules\Campaigns\Models\Campaign', 'campaign_id')->withDefault();
    }
}
