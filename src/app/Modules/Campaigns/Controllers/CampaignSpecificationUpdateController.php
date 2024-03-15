<?php

namespace App\Modules\Campaigns\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Requests\CampaignAmenitiesUpdateRequest;
use App\Modules\Campaigns\Services\CampaignSpecificationService;

class CampaignSpecificationUpdateController extends Controller
{
    private $campaignSpecificationService;

    public function __construct(CampaignSpecificationService $campaignSpecificationService)
    {
        $this->middleware('permission:campaigns', ['only' => ['get','post']]);
        $this->campaignSpecificationService = $campaignSpecificationService;
    }

    public function get(Int $campaign_id, Int $id){
        $data = $this->campaignSpecificationService->getById($id);
        return view('admin.pages.campaigns.specification.update')->with(
            [
                'data' => $data,
                'campaign_id' => $campaign_id,
            ]
        );
    }

    public function post(CampaignAmenitiesUpdateRequest $request, Int $campaign_id,  Int $id){
        $data = $this->campaignSpecificationService->getById($id);
        try {
            //code...
            $this->campaignSpecificationService->update_image($request, $data);
            $this->campaignSpecificationService->update($request, $data);
            return redirect()->intended(route('campaign_specification_update.get', [$campaign_id, $id]))->with('success_status', 'Campaign Specification updated successfully.');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect(route('campaign_specification_update.get', [$campaign_id, $id]))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}