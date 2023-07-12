<?php

namespace App\Modules\Campaigns\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Services\CampaignConnectivityService;
use App\Modules\Campaigns\Services\CampaignService;
use Illuminate\Http\Request;

class CampaignConnectivityPaginateController extends Controller
{
    private $campaignConnectivityService;
    private $campaignService;

    public function __construct(CampaignConnectivityService $campaignConnectivityService, CampaignService $campaignService)
    {
        $this->middleware('permission:campaigns', ['only' => ['get','post']]);
        $this->campaignConnectivityService = $campaignConnectivityService;
        $this->campaignService = $campaignService;
    }

    public function get(Request $request, Int $campaign_id){
        $campaign = $this->campaignService->getById($campaign_id);
        $data = $this->campaignConnectivityService->paginate($request, 10, $campaign_id);
        return view('admin.pages.campaigns.connectivity.paginate')->with(
            [
                'data' => $data,
                'campaign' => $campaign,
                'campaign_id' => $campaign_id,
            ]
        )->with('search', $request->query('filter')['search'] ?? '');
    }
}
