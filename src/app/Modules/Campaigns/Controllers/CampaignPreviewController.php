<?php

namespace App\Modules\Campaigns\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Services\CampaignService;

class CampaignPreviewController extends Controller
{
    private $campaignService;

    public function __construct(CampaignService $campaignService)
    {
        $this->middleware('permission:campaigns', ['only' => ['get','post']]);
        $this->campaignService = $campaignService;
    }

    public function get($id){
        $data = $this->campaignService->getPreview($id);
        return view('campaign.pages.index')->with('data', $data);
    }
}
