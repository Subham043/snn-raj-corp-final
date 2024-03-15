<?php

namespace App\Modules\Campaigns\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Services\CampaignService;
use App\Modules\Campaigns\Requests\CampaignConnectivityRequest;
use App\Modules\Campaigns\Services\CampaignConnectivityService;

class CampaignConnectivityCreateController extends Controller
{
    private $campaignService;
    private $campaignConnectivityService;

    public function __construct(CampaignConnectivityService $campaignConnectivityService, CampaignService $campaignService)
    {
        $this->middleware('permission:campaigns', ['only' => ['get','post']]);
        $this->campaignService = $campaignService;
        $this->campaignConnectivityService = $campaignConnectivityService;
    }

    public function get(Int $campaign_id){
        $this->campaignService->getById($campaign_id);
        return view('admin.pages.campaigns.connectivity.create')->with(
            [
                'campaign_id' => $campaign_id
            ]
        );
    }

    public function post(CampaignConnectivityRequest $request, Int $campaign_id){
        $this->campaignService->getById($campaign_id);
        try {
            //code...
            $this->campaignConnectivityService->create($request, $campaign_id);
            return redirect()->intended(route('campaign_connectivity_create.get', $campaign_id))->with('success_status', 'Campaign Connectivity created successfully.');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect(route('campaign_connectivity_create.get', $campaign_id))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}