<?php

namespace App\Modules\Campaigns\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Requests\CampaignAmenitiesUpdateRequest;
use App\Modules\Campaigns\Services\CampaignAmenitiesService;

class CampaignAmenitiesUpdateController extends Controller
{
    private $campaignAmenitiesService;

    public function __construct(CampaignAmenitiesService $campaignAmenitiesService)
    {
        $this->middleware('permission:campaigns', ['only' => ['get','post']]);
        $this->campaignAmenitiesService = $campaignAmenitiesService;
    }

    public function get(Int $campaign_id, Int $id){
        $data = $this->campaignAmenitiesService->getById($id);
        return view('admin.pages.campaigns.amenities.update')->with(
            [
                'data' => $data,
                'campaign_id' => $campaign_id,
            ]
        );
    }

    public function post(CampaignAmenitiesUpdateRequest $request, Int $campaign_id,  Int $id){
        $data = $this->campaignAmenitiesService->getById($id);
        try {
            //code...
            $this->campaignAmenitiesService->update_image($request, $data);
            $this->campaignAmenitiesService->update($request, $data);
            return redirect()->intended(route('campaign_amenities_update.get', [$campaign_id, $id]))->with('success_status', 'Campaign Amenity updated successfully.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect(route('campaign_amenities_update.get', [$campaign_id, $id]))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}
