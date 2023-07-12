<?php

namespace App\Modules\Campaigns\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Services\CampaignService;
use App\Modules\Campaigns\Requests\CampaignAmenitiesCreateRequest;
use App\Modules\Campaigns\Services\CampaignSpecificationService;

class CampaignSpecificationCreateController extends Controller
{
    private $campaignService;
    private $campaignSpecificationService;

    public function __construct(CampaignSpecificationService $campaignSpecificationService, CampaignService $campaignService)
    {
        $this->middleware('permission:campaigns', ['only' => ['get','post']]);
        $this->campaignService = $campaignService;
        $this->campaignSpecificationService = $campaignSpecificationService;
    }

    public function get(Int $campaign_id){
        $this->campaignService->getById($campaign_id);
        return view('admin.pages.campaigns.specification.create')->with(
            [
                'campaign_id' => $campaign_id
            ]
        );
    }

    public function post(CampaignAmenitiesCreateRequest $request, Int $campaign_id){
        $this->campaignService->getById($campaign_id);
        try {
            //code...
            $this->campaignSpecificationService->create($request, $campaign_id);
            return redirect()->intended(route('campaign_specification_create.get', $campaign_id))->with('success_status', 'Campaign Specification created successfully.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect(route('campaign_specification_create.get', $campaign_id))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}
