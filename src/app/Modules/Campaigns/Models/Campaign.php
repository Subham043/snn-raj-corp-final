<?php

namespace App\Modules\Campaigns\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Enums\CampaignStatusEnum;
use App\Enums\PublishStatusEnum;

class Campaign extends Model
{
    use HasFactory;

    protected $table = 'campaigns';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'header_logo',
        'footer_logo',
        'brochure_bg_image',
        'address',
        'email',
        'phone',
        'srd',
        'projectId',
        'meta_title',
        'meta_description',
        'og_locale',
        'og_type',
        'og_description',
        'og_site_name',
        'og_image',
        'meta_header',
        'meta_footer',
        'facebook',
        'instagram',
        'youtube',
        'linkedin',
        'campaign_status',
        'publish_status',
        'table_heading',
        'table_main_heading',
        'gallery_heading',
        'specification_heading',
        'plan_heading',
        'location_heading',
        'connectivity_heading',
        'amenities_heading',
    ];

    protected $attributes = [
        'campaign_status' => 1,
        'publish_status' => 1,
        'table_heading' => 'Double Height Ceilings & <span>18 Feet Tall Windows</span>',
        'table_main_heading' => 'Raj Viviente by SNN Raj Corp <bt/>Luxury 4BHK Villas Off Bannerghatta Rd',
        'gallery_heading' => 'Image <span>Gallery</span>',
        'specification_heading' => 'Villas With Design Influences From <span>10+ Countries</span>',
        'plan_heading' => 'Master & <span>Unit Plans</span>',
        'location_heading' => 'Prime <span>Location</span>',
        'connectivity_heading' => 'Connectivity <span>At Its Best</span>',
        'amenities_heading' => '20+ Worldclass <span>Amenities</span>',
    ];

    protected $appends = ['campaign_status_type', 'publish_status_type', 'header_logo_link', 'footer_logo_link', 'og_image_link', 'brochure_bg_image_link', 'meta_header_nonce', 'meta_footer_nonce'];

    protected function campaignStatusType(): Attribute
    {
        return new Attribute(
            get: fn () => CampaignStatusEnum::getValue($this->campaign_status),
        );
    }

    protected function publishStatusType(): Attribute
    {
        return new Attribute(
            get: fn () => PublishStatusEnum::getValue($this->campaign_status),
        );
    }

    protected function headerLogoLink(): Attribute
    {
        return new Attribute(
            get: fn () => asset('storage/campaigns/'.$this->header_logo),
        );
    }

    protected function footerLogoLink(): Attribute
    {
        return new Attribute(
            get: fn () => asset('storage/campaigns/'.$this->footer_logo),
        );
    }

    protected function ogImageLink(): Attribute
    {
        return new Attribute(
            get: fn () => !empty($this->og_image) ? asset('storage/campaigns/'.$this->og_image): null,
        );
    }

    protected function brochureBgImageLink(): Attribute
    {
        return new Attribute(
            get: fn () => !empty($this->brochure_bg_image) ? asset('storage/campaigns/'.$this->brochure_bg_image): null,
        );
    }

    protected function metaHeaderNonce(): Attribute
    {
        return new Attribute(
            get: fn () => str_replace("<script","<script nonce='".csp_nonce()."'",$this->meta_header),
        );
    }

    protected function metaFooterNonce(): Attribute
    {
        return new Attribute(
            get: fn () => str_replace("<script","<script nonce='".csp_nonce()."'",$this->meta_footer),
        );
    }

    public function CampaignBanner()
    {
        return $this->hasOne('App\Modules\Campaigns\Models\CampaignBanner', 'campaign_id');
    }

    public function CampaignAbout()
    {
        return $this->hasOne('App\Modules\Campaigns\Models\CampaignAbout', 'campaign_id');
    }

    public function CampaignThank()
    {
        return $this->hasOne('App\Modules\Campaigns\Models\CampaignThank', 'campaign_id');
    }

    public function CampaignLocation()
    {
        return $this->hasOne('App\Modules\Campaigns\Models\CampaignLocation', 'campaign_id');
    }

    public function CampaignAmenities()
    {
        return $this->hasMany('App\Modules\Campaigns\Models\CampaignAmenities', 'campaign_id');
    }

    public function CampaignTable()
    {
        return $this->hasMany('App\Modules\Campaigns\Models\CampaignTable', 'campaign_id');
    }

    public function CampaignConnectivity()
    {
        return $this->hasMany('App\Modules\Campaigns\Models\CampaignConnectivity', 'campaign_id');
    }

    public function CampaignPlanCategory()
    {
        return $this->hasMany('App\Modules\Campaigns\Models\CampaignPlanCategory', 'campaign_id');
    }

    public function CampaignSpecification()
    {
        return $this->hasMany('App\Modules\Campaigns\Models\CampaignSpecification', 'campaign_id');
    }

    public function CampaignGallery()
    {
        return $this->hasMany('App\Modules\Campaigns\Models\CampaignGallery', 'campaign_id');
    }
}
