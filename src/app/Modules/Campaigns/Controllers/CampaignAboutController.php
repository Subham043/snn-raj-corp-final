<?php

namespace App\Modules\Campaigns\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Requests\CampaignAboutRequest;
use App\Modules\Campaigns\Services\CampaignService;
use App\Modules\Campaigns\Services\CampaignAboutService;

class CampaignAboutController extends Controller
{
    private $campaignService;
    private $campaignAboutService;

    public function __construct(CampaignAboutService $campaignAboutService, CampaignService $campaignService)
    {
        $this->middleware('permission:campaigns', ['only' => ['get','post']]);
        $this->campaignService = $campaignService;
        $this->campaignAboutService = $campaignAboutService;
    }

    public function get(Int $campaign_id){
        $this->campaignService->getById($campaign_id);
        $data = $this->campaignAboutService->getByCampaignId($campaign_id);
        return view('admin.pages.campaigns.about')->with(
            [
                'data' => $data,
                'campaign_id' => $campaign_id
            ]
        );
    }

    public function post(CampaignAboutRequest $request, Int $campaign_id){
        $this->campaignService->getById($campaign_id);
        try {
            //code...
            $this->campaignAboutService->createOrUpdate($request, $campaign_id);
            return redirect()->intended(route('campaign_about.get', $campaign_id))->with('success_status', 'Campaign About Details saved successfully.');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect(route('campaign_about.get', $campaign_id))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}
