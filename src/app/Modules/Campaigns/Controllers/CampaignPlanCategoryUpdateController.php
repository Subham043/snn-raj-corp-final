<?php

namespace App\Modules\Campaigns\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Requests\CampaignPlanCategoryRequest;
use App\Modules\Campaigns\Services\CampaignPlanCategoryService;

class CampaignPlanCategoryUpdateController extends Controller
{
    private $campaignPlanCategoryService;

    public function __construct(CampaignPlanCategoryService $campaignPlanCategoryService)
    {
        $this->middleware('permission:campaigns', ['only' => ['get','post']]);
        $this->campaignPlanCategoryService = $campaignPlanCategoryService;
    }

    public function get(Int $campaign_id, Int $id){
        $data = $this->campaignPlanCategoryService->getById($id);
        return view('admin.pages.campaigns.plan_category.update')->with(
            [
                'data' => $data,
                'campaign_id' => $campaign_id,
            ]
        );
    }

    public function post(CampaignPlanCategoryRequest $request, Int $campaign_id,  Int $id){
        $data = $this->campaignPlanCategoryService->getById($id);
        try {
            //code...
            $this->campaignPlanCategoryService->update($request, $data);
            return redirect()->intended(route('campaign_plan_category_update.get', [$campaign_id, $id]))->with('success_status', 'Campaign Plan Category updated successfully.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect(route('campaign_plan_category_update.get', [$campaign_id, $id]))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}
