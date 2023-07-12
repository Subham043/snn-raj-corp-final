<?php

namespace App\Modules\Campaigns\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Services\CampaignService;
use App\Modules\Campaigns\Requests\CampaignAmenitiesCreateRequest;
use App\Modules\Campaigns\Services\CampaignAmenitiesService;

class CampaignAmenitiesCreateController extends Controller
{
    private $campaignService;
    private $campaignAmenitiesService;

    public function __construct(CampaignAmenitiesService $campaignAmenitiesService, CampaignService $campaignService)
    {
        $this->middleware('permission:campaigns', ['only' => ['get','post']]);
        $this->campaignService = $campaignService;
        $this->campaignAmenitiesService = $campaignAmenitiesService;
    }

    public function get(Int $campaign_id){
        $this->campaignService->getById($campaign_id);
        return view('admin.pages.campaigns.amenities.create')->with(
            [
                'campaign_id' => $campaign_id
            ]
        );
    }

    public function post(CampaignAmenitiesCreateRequest $request, Int $campaign_id){
        $this->campaignService->getById($campaign_id);
        try {
            //code...
            $this->campaignAmenitiesService->create($request, $campaign_id);
            return redirect()->intended(route('campaign_amenities_create.get', $campaign_id))->with('success_status', 'Campaign Amenity created successfully.');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect(route('campaign_amenities_create.get', $campaign_id))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}
