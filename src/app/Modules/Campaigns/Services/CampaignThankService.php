<?php

namespace App\Modules\Campaigns\Services;

use App\Modules\Campaigns\Models\CampaignThank;
use App\Modules\Campaigns\Requests\CampaignThankRequest;

class CampaignThankService
{
    private $campaignThankModel;

    public function __construct(CampaignThank $campaignThankModel)
    {
        $this->campaignThankModel = $campaignThankModel;
    }

    public function getById(Int $id): CampaignThank
    {
        return $this->campaignThankModel->findOrFail($id);
    }

    public function getByCampaignId(Int $campaign_id): CampaignThank|null
    {
        return $this->campaignThankModel->where('campaign_id', $campaign_id)->first();
    }

    public function createOrUpdate(CampaignThankRequest $request, Int $campaign_id) : void
    {
        $this->campaignThankModel->updateOrCreate(
            ['campaign_id' => $campaign_id],
            [
                ...$request->validated(),
            ]
        );
    }
}
