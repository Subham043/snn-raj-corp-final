<?php

namespace App\Modules\Campaigns\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Requests\CampaignThankRequest;
use App\Modules\Campaigns\Services\CampaignService;
use App\Modules\Campaigns\Services\CampaignThankService;

class CampaignThankController extends Controller
{
    private $campaignService;
    private $campaignThankService;

    public function __construct(CampaignThankService $campaignThankService, CampaignService $campaignService)
    {
        $this->middleware('permission:campaigns', ['only' => ['get','post']]);
        $this->campaignService = $campaignService;
        $this->campaignThankService = $campaignThankService;
    }

    public function get(Int $campaign_id){
        $this->campaignService->getById($campaign_id);
        $data = $this->campaignThankService->getByCampaignId($campaign_id);
        return view('admin.pages.campaigns.thank')->with(
            [
                'data' => $data,
                'campaign_id' => $campaign_id
            ]
        );
    }

    public function post(CampaignThankRequest $request, Int $campaign_id){
        $this->campaignService->getById($campaign_id);
        try {
            //code...
            $this->campaignThankService->createOrUpdate($request, $campaign_id);
            return redirect()->intended(route('campaign_thank.get', $campaign_id))->with('success_status', 'Campaign Thank You Details saved successfully.');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect(route('campaign_thank.get', $campaign_id))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}
