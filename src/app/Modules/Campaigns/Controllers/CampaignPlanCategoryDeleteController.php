<?php

namespace App\Modules\Campaigns\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Services\CampaignPlanCategoryService;

class CampaignPlanCategoryDeleteController extends Controller
{
    private $campaignPlanCategoryService;

    public function __construct(CampaignPlanCategoryService $campaignPlanCategoryService)
    {
        $this->middleware('permission:campaigns', ['only' => ['get','post']]);
        $this->campaignPlanCategoryService = $campaignPlanCategoryService;
    }

    public function get(Int $campaign_id, Int $id){
        $data = $this->campaignPlanCategoryService->getById($id);
        try {
            //code...
            $this->campaignPlanCategoryService->delete($data);
            return redirect()->intended(route('campaign_plan_category_list.get', $campaign_id))->with('success_status', 'Campaign Plan Category deleted successfully.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect(route('campaign_plan_category_list.get', $campaign_id))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }
    }
}
