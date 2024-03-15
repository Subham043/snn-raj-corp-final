<?php

namespace App\Modules\Campaigns\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Services\CampaignConnectivityService;

class CampaignConnectivityDeleteController extends Controller
{
    private $campaignConnectivityService;

    public function __construct(CampaignConnectivityService $campaignConnectivityService)
    {
        $this->middleware('permission:campaigns', ['only' => ['get','post']]);
        $this->campaignConnectivityService = $campaignConnectivityService;
    }

    public function get(Int $campaign_id, Int $id){
        $data = $this->campaignConnectivityService->getById($id);
        try {
            //code...
            $this->campaignConnectivityService->delete($data);
            return redirect()->intended(route('campaign_connectivity_list.get', $campaign_id))->with('success_status', 'Campaign Connectivity deleted successfully.');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect(route('campaign_connectivity_list.get', $campaign_id))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }
    }
}