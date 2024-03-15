<?php

namespace App\Modules\Campaigns\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Services\CampaignAmenitiesService;

class CampaignAmenitiesDeleteController extends Controller
{
    private $campaignAmenitiesService;

    public function __construct(CampaignAmenitiesService $campaignAmenitiesService)
    {
        $this->middleware('permission:campaigns', ['only' => ['get','post']]);
        $this->campaignAmenitiesService = $campaignAmenitiesService;
    }

    public function get(Int $campaign_id, Int $id){
        $data = $this->campaignAmenitiesService->getById($id);
        try {
            //code...
            $this->campaignAmenitiesService->delete($data);
            return redirect()->intended(route('campaign_amenities_list.get', $campaign_id))->with('success_status', 'Campaign Amenity deleted successfully.');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect(route('campaign_amenities_list.get', $campaign_id))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }
    }
}