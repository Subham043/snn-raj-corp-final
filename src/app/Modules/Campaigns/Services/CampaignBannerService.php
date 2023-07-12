<?php

namespace App\Modules\Campaigns\Services;

use App\Http\Services\CampaignFileService;
use App\Modules\Campaigns\Models\CampaignBanner;
use App\Modules\Campaigns\Requests\CampaignBannerRequest;

class CampaignBannerService
{
    private $campaignBannerModel;
    private $path = 'campaigns_banner';

    public function __construct(CampaignBanner $campaignBannerModel)
    {
        $this->campaignBannerModel = $campaignBannerModel;
    }

    public function getById(Int $id): CampaignBanner
    {
        return $this->campaignBannerModel->findOrFail($id);
    }

    public function getByCampaignId(Int $campaign_id): CampaignBanner|null
    {
        return $this->campaignBannerModel->where('campaign_id', $campaign_id)->first();
    }

    public function createOrUpdate(CampaignBannerRequest $request, Int $campaign_id) : void
    {
        $file_array = [];
        if($request->hasFile('banner_image')){
            $banner_image = (new CampaignFileService)->save_file($request, 'banner_image', $this->path);
            $file_array['banner_image'] = $banner_image;
        }

        $this->campaignBannerModel->updateOrCreate(
            ['campaign_id' => $campaign_id],
            [
                ...$request->except('banner_image'),
                ...$file_array
            ]
        );
    }
}
