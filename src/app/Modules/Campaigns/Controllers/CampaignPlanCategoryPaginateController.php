<?php

namespace App\Modules\Campaigns\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Services\CampaignPlanCategoryService;
use App\Modules\Campaigns\Services\CampaignService;
use Illuminate\Http\Request;

class CampaignPlanCategoryPaginateController extends Controller
{
    private $campaignPlanCategoryService;
    private $campaignService;

    public function __construct(CampaignPlanCategoryService $campaignPlanCategoryService, CampaignService $campaignService)
    {
        $this->middleware('permission:campaigns', ['only' => ['get','post']]);
        $this->campaignPlanCategoryService = $campaignPlanCategoryService;
        $this->campaignService = $campaignService;
    }

    public function get(Request $request, Int $campaign_id){
        $campaign = $this->campaignService->getById($campaign_id);
        $data = $this->campaignPlanCategoryService->paginate($request, 10, $campaign_id);
        return view('admin.pages.campaigns.plan_category.paginate')->with(
            [
                'data' => $data,
                'campaign' => $campaign,
                'campaign_id' => $campaign_id,
            ]
        )->with('search', $request->query('filter')['search'] ?? '');
    }
}
