<?php

namespace App\Modules\Campaigns\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Requests\CampaignLocationRequest;
use App\Modules\Campaigns\Services\CampaignService;
use App\Modules\Campaigns\Services\CampaignLocationService;

class CampaignLocationController extends Controller
{
    private $campaignService;
    private $campaignLocationService;

    public function __construct(CampaignLocationService $campaignLocationService, CampaignService $campaignService)
    {
        $this->middleware('permission:campaigns', ['only' => ['get','post']]);
        $this->campaignService = $campaignService;
        $this->campaignLocationService = $campaignLocationService;
    }

    public function get(Int $campaign_id){
        $campaign = $this->campaignService->getById($campaign_id);
        $data = $this->campaignLocationService->getByCampaignId($campaign_id);
        return view('admin.pages.campaigns.location')->with(
            [
                'data' => $data,
                'campaign' => $campaign,
                'campaign_id' => $campaign_id
            ]
        );
    }

    public function post(CampaignLocationRequest $request, Int $campaign_id){
        $campaign = $this->campaignService->getById($campaign_id);
        try {
            //code...
            $this->campaignLocationService->createOrUpdate($request, $campaign_id);
            $this->campaignService->updateHeading($request->only('location_heading'), $campaign);
            return redirect()->intended(route('campaign_location.get', $campaign_id))->with('success_status', 'Campaign Location Details saved successfully.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect(route('campaign_location.get', $campaign_id))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}
