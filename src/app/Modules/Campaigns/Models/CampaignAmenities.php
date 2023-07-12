<?php

namespace App\Modules\Campaigns\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class CampaignAmenities extends Model
{
    use HasFactory;

    protected $table = 'campaign_amenities_sections';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'icon_image',
        'campaign_id',
    ];

    protected $appends = ['icon_image_link'];

    protected function iconImageLink(): Attribute
    {
        return new Attribute(
            get: fn () => asset('storage/campaigns_amenities/'.$this->icon_image),
        );
    }

    public function Campaign()
    {
        return $this->belongsTo('App\Modules\Campaigns\Models\Campaign', 'campaign_id')->withDefault();
    }
}
