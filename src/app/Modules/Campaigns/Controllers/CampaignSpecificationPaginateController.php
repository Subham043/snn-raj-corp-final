<?php

namespace App\Modules\Campaigns\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Services\CampaignSpecificationService;
use App\Modules\Campaigns\Services\CampaignService;
use Illuminate\Http\Request;

class CampaignSpecificationPaginateController extends Controller
{
    private $campaignSpecificationService;
    private $campaignService;

    public function __construct(CampaignSpecificationService $campaignSpecificationService, CampaignService $campaignService)
    {
        $this->middleware('permission:campaigns', ['only' => ['get','post']]);
        $this->campaignSpecificationService = $campaignSpecificationService;
        $this->campaignService = $campaignService;
    }

    public function get(Request $request, Int $campaign_id){
        $campaign = $this->campaignService->getById($campaign_id);
        $data = $this->campaignSpecificationService->paginate($request, 10, $campaign_id);
        return view('admin.pages.campaigns.specification.paginate')->with(
            [
                'data' => $data,
                'campaign' => $campaign,
                'campaign_id' => $campaign_id,
            ]
        )->with('search', $request->query('filter')['search'] ?? '');
    }
}
