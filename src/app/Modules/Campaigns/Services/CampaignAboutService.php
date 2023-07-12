<?php

namespace App\Modules\Campaigns\Services;

use App\Http\Services\CampaignFileService;
use App\Modules\Campaigns\Models\CampaignAbout;
use App\Modules\Campaigns\Requests\CampaignAboutRequest;

class CampaignAboutService
{
    private $campaignAboutModel;
    private $path = 'campaigns_about';

    public function __construct(CampaignAbout $campaignAboutModel)
    {
        $this->campaignAboutModel = $campaignAboutModel;
    }

    public function getById(Int $id): CampaignAbout
    {
        return $this->campaignAboutModel->findOrFail($id);
    }

    public function getByCampaignId(Int $campaign_id): CampaignAbout|null
    {
        return $this->campaignAboutModel->where('campaign_id', $campaign_id)->first();
    }

    public function createOrUpdate(CampaignAboutRequest $request, Int $campaign_id) : void
    {
        $file_array = [];
        if($request->hasFile('left_image')){
            $left_image = (new CampaignFileService)->save_file($request, 'left_image', $this->path);
            $file_array['left_image'] = $left_image;
        }
        if($request->hasFile('about_logo')){
            $about_logo = (new CampaignFileService)->save_file($request, 'about_logo', $this->path);
            $file_array['about_logo'] = $about_logo;
        }

        $this->campaignAboutModel->updateOrCreate(
            ['campaign_id' => $campaign_id],
            [
                ...$request->except('left_image', 'about_logo'),
                ...$file_array
            ]
        );
    }
}
