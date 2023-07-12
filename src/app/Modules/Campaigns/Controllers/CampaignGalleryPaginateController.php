<?php

namespace App\Modules\Campaigns\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Services\CampaignGalleryService;
use App\Modules\Campaigns\Services\CampaignService;

class CampaignGalleryPaginateController extends Controller
{
    private $campaignGalleryService;
    private $campaignService;

    public function __construct(CampaignGalleryService $campaignGalleryService, CampaignService $campaignService)
    {
        $this->middleware('permission:campaigns', ['only' => ['get','post']]);
        $this->campaignGalleryService = $campaignGalleryService;
        $this->campaignService = $campaignService;
    }

    public function get(Int $campaign_id){
        $campaign = $this->campaignService->getById($campaign_id);
        $data = $this->campaignGalleryService->paginate(10, $campaign_id);
        return view('admin.pages.campaigns.gallery.paginate')->with(
            [
                'data' => $data,
                'campaign' => $campaign,
                'campaign_id' => $campaign_id,
            ]
        );
    }
}
