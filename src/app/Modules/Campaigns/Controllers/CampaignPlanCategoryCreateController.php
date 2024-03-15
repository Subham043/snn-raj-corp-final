<?php

namespace App\Modules\Campaigns\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Services\CampaignService;
use App\Modules\Campaigns\Requests\CampaignPlanCategoryRequest;
use App\Modules\Campaigns\Services\CampaignPlanCategoryService;

class CampaignPlanCategoryCreateController extends Controller
{
    private $campaignService;
    private $campaignPlanCategoryService;

    public function __construct(CampaignPlanCategoryService $campaignPlanCategoryService, CampaignService $campaignService)
    {
        $this->middleware('permission:campaigns', ['only' => ['get','post']]);
        $this->campaignService = $campaignService;
        $this->campaignPlanCategoryService = $campaignPlanCategoryService;
    }

    public function get(Int $campaign_id){
        $this->campaignService->getById($campaign_id);
        return view('admin.pages.campaigns.plan_category.create')->with(
            [
                'campaign_id' => $campaign_id
            ]
        );
    }

    public function post(CampaignPlanCategoryRequest $request, Int $campaign_id){
        $this->campaignService->getById($campaign_id);
        try {
            //code...
            $this->campaignPlanCategoryService->create($request, $campaign_id);
            return redirect()->intended(route('campaign_plan_category_create.get', $campaign_id))->with('success_status', 'Campaign Plan Category created successfully.');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect(route('campaign_plan_category_create.get', $campaign_id))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}