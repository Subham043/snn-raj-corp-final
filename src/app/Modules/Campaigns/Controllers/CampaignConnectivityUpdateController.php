<?php

namespace App\Modules\Campaigns\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Requests\CampaignConnectivityRequest;
use App\Modules\Campaigns\Services\CampaignConnectivityService;

class CampaignConnectivityUpdateController extends Controller
{
    private $campaignConnectivityService;

    public function __construct(CampaignConnectivityService $campaignConnectivityService)
    {
        $this->middleware('permission:campaigns', ['only' => ['get','post']]);
        $this->campaignConnectivityService = $campaignConnectivityService;
    }

    public function get(Int $campaign_id, Int $id){
        $data = $this->campaignConnectivityService->getById($id);
        return view('admin.pages.campaigns.connectivity.update')->with(
            [
                'data' => $data,
                'campaign_id' => $campaign_id,
            ]
        );
    }

    public function post(CampaignConnectivityRequest $request, Int $campaign_id,  Int $id){
        $data = $this->campaignConnectivityService->getById($id);
        try {
            //code...
            $this->campaignConnectivityService->update($request, $data);
            return redirect()->intended(route('campaign_connectivity_update.get', [$campaign_id, $id]))->with('success_status', 'Campaign Connectivity updated successfully.');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect(route('campaign_connectivity_update.get', [$campaign_id, $id]))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}