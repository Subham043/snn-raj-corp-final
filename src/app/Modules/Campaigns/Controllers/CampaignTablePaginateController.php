<?php

namespace App\Modules\Campaigns\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Services\CampaignTableService;
use App\Modules\Campaigns\Services\CampaignService;
use Illuminate\Http\Request;

class CampaignTablePaginateController extends Controller
{
    private $campaignTableService;
    private $campaignService;

    public function __construct(CampaignTableService $campaignTableService, CampaignService $campaignService)
    {
        $this->middleware('permission:campaigns', ['only' => ['get','post']]);
        $this->campaignTableService = $campaignTableService;
        $this->campaignService = $campaignService;
    }

    public function get(Request $request, Int $campaign_id){
        $campaign = $this->campaignService->getById($campaign_id);
        $data = $this->campaignTableService->paginate($request, 10, $campaign_id);
        return view('admin.pages.campaigns.table.paginate')->with(
            [
                'data' => $data,
                'campaign' => $campaign,
                'campaign_id' => $campaign_id,
            ]
        )->with('search', $request->query('filter')['search'] ?? '');
    }
}
