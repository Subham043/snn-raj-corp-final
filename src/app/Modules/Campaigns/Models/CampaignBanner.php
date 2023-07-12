<?php

namespace App\Modules\Campaigns\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class CampaignBanner extends Model
{
    use HasFactory;

    protected $table = 'campaign_banner_sections';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'banner_image',
        'heading',
        'sub_heading',
        'points',
        'campaign_id',
    ];

    protected $appends = ['banner_image_link', 'points_list'];

    protected function bannerImageLink(): Attribute
    {
        return new Attribute(
            get: fn () => asset('storage/campaigns_banner/'.$this->banner_image),
        );
    }

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
