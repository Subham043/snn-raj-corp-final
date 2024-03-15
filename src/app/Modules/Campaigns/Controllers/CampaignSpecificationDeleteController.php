<?php

namespace App\Modules\Campaigns\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Services\CampaignSpecificationService;

class CampaignSpecificationDeleteController extends Controller
{
    private $campaignSpecificationService;

    public function __construct(CampaignSpecificationService $campaignSpecificationService)
    {
        $this->middleware('permission:campaigns', ['only' => ['get','post']]);
        $this->campaignSpecificationService = $campaignSpecificationService;
    }

    public function get(Int $campaign_id, Int $id){
        $data = $this->campaignSpecificationService->getById($id);
        try {
            //code...
            $this->campaignSpecificationService->delete($data);
            return redirect()->intended(route('campaign_specification_list.get', $campaign_id))->with('success_status', 'Campaign Specification deleted successfully.');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect(route('campaign_specification_list.get', $campaign_id))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }
    }
}