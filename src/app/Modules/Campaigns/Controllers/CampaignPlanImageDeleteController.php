<?php

namespace App\Modules\Campaigns\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Services\CampaignPlanImageService;

class CampaignPlanImageDeleteController extends Controller
{
    private $campaignPlanImageService;

    public function __construct(CampaignPlanImageService $campaignPlanImageService)
    {
        $this->middleware('permission:campaigns', ['only' => ['get','post']]);
        $this->campaignPlanImageService = $campaignPlanImageService;
    }

    public function get(Int $campaign_id, Int $category_id, Int $id){
        $data = $this->campaignPlanImageService->getById($id);
        try {
            //code...
            $this->campaignPlanImageService->delete($data);
            return redirect()->intended(route('campaign_plan_image_list.get', [$campaign_id, $category_id]))->with('success_status', 'Campaign Plan Image deleted successfully.');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect(route('campaign_plan_image_list.get', [$campaign_id, $category_id]))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }
    }
}