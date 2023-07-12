<?php

namespace App\Modules\Campaigns\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class CampaignLocation extends Model
{
    use HasFactory;

    protected $table = 'campaign_location_sections';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'location',
        'description',
        'map_image',
        'campaign_id',
    ];

    protected $appends = ['map_image_link'];

    protected function mapImageLink(): Attribute
    {
        return new Attribute(
            get: fn () => asset('storage/campaigns_location/'.$this->map_image),
        );
    }

    public function Campaign()
    {
        return $this->belongsTo('App\Modules\Campaigns\Models\Campaign', 'campaign_id')->withDefault();
    }
}
