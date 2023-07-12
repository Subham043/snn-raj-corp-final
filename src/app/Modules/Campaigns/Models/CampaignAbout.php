<?php

namespace App\Modules\Campaigns\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class CampaignAbout extends Model
{
    use HasFactory;

    protected $table = 'campaign_about_sections';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rera',
        'left_image',
        'about_logo',
        'description',
        'campaign_id',
    ];

    protected $appends = ['about_logo_link', 'left_image_link'];

    protected function aboutLogoLink(): Attribute
    {
        return new Attribute(
            get: fn () => asset('storage/campaigns_about/'.$this->about_logo),
        );
    }

    protected function leftImageLink(): Attribute
    {
        return new Attribute(
            get: fn () => asset('storage/campaigns_about/'.$this->left_image),
        );
    }

    public function Campaign()
    {
        return $this->belongsTo('App\Modules\Campaigns\Models\Campaign', 'campaign_id')->withDefault();
    }
}
