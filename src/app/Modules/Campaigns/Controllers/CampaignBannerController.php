<?php

namespace App\Modules\Campaigns\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Requests\CampaignBannerRequest;
use App\Modules\Campaigns\Services\CampaignService;
use App\Modules\Campaigns\Services\CampaignBannerService;

class CampaignBannerController extends Controller
{
    private $campaignService;
    private $campaignBannerService;

    public function __construct(CampaignBannerService $campaignBannerService, CampaignService $campaignService)
    {
        $this->middleware('permission:campaigns', ['only' => ['get','post']]);
        $this->campaignService = $campaignService;
        $this->campaignBannerService = $campaignBannerService;
    }

    public function get(Int $campaign_id){
        $this->campaignService->getById($campaign_id);
        $data = $this->campaignBannerService->getByCampaignId($campaign_id);
        return view('admin.pages.campaigns.banner')->with(
            [
                'data' => $data,
                'campaign_id' => $campaign_id
            ]
        );
    }

    public function post(CampaignBannerRequest $request, Int $campaign_id){
        $this->campaignService->getById($campaign_id);
        try {
            //code...
            $this->campaignBannerService->createOrUpdate($request, $campaign_id);
            return redirect()->intended(route('campaign_banner.get', $campaign_id))->with('success_status', 'Campaign Banner Details saved successfully.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect(route('campaign_banner.get', $campaign_id))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}
