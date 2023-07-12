<?php

namespace App\Modules\Campaigns\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Services\CampaignAmenitiesService;
use App\Modules\Campaigns\Services\CampaignService;
use Illuminate\Http\Request;

class CampaignAmenitiesPaginateController extends Controller
{
    private $campaignAmenitiesService;
    private $campaignService;

    public function __construct(CampaignAmenitiesService $campaignAmenitiesService, CampaignService $campaignService)
    {
        $this->middleware('permission:campaigns', ['only' => ['get','post']]);
        $this->campaignAmenitiesService = $campaignAmenitiesService;
        $this->campaignService = $campaignService;
    }

    public function get(Request $request, Int $campaign_id){
        $campaign = $this->campaignService->getById($campaign_id);
        $data = $this->campaignAmenitiesService->paginate($request, 10, $campaign_id);
        return view('admin.pages.campaigns.amenities.paginate')->with(
            [
                'data' => $data,
                'campaign' => $campaign,
                'campaign_id' => $campaign_id,
            ]
        )->with('search', $request->query('filter')['search'] ?? '');
    }
}
