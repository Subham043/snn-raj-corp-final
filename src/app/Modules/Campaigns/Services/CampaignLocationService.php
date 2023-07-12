<?php

namespace App\Modules\Campaigns\Services;

use App\Http\Services\CampaignFileService;
use App\Modules\Campaigns\Models\CampaignLocation;
use App\Modules\Campaigns\Requests\CampaignLocationRequest;

class CampaignLocationService
{
    private $campaignLocationModel;
    private $path = 'campaigns_location';

    public function __construct(CampaignLocation $campaignLocationModel)
    {
        $this->campaignLocationModel = $campaignLocationModel;
    }

    public function getById(Int $id): CampaignLocation
    {
        return $this->campaignLocationModel->findOrFail($id);
    }

    public function getByCampaignId(Int $campaign_id): CampaignLocation|null
    {
        return $this->campaignLocationModel->where('campaign_id', $campaign_id)->first();
    }

    public function createOrUpdate(CampaignLocationRequest $request, Int $campaign_id) : void
    {
        $map_image = (new CampaignFileService)->save_file($request, 'map_image', $this->path);
        $this->campaignLocationModel->updateOrCreate(
            ['campaign_id' => $campaign_id],
            [
                ...$request->except('location_heading', 'map_image'),
                'map_image' => $map_image,
            ]
        );
    }
}
