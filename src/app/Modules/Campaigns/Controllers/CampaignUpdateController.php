<?php

namespace App\Modules\Campaigns\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Requests\CampaignUpdateRequest;
use App\Modules\Campaigns\Services\CampaignService;

class CampaignUpdateController extends Controller
{
    private $campaignService;

    public function __construct(CampaignService $campaignService)
    {
        $this->middleware('permission:campaigns', ['only' => ['get','post']]);
        $this->campaignService = $campaignService;
    }

    public function get(Int $id){
        $data = $this->campaignService->getById($id);
        return view('admin.pages.campaigns.update')->with(
            [
                'data' => $data
            ]
        );
    }

    public function post(CampaignUpdateRequest $request, Int $id){
        $data = $this->campaignService->getById($id);
        try {
            //code...
            $this->campaignService->update_image($request, $data);
            $this->campaignService->update($request, $data);
            return redirect()->intended(route('campaign_update.get', $id))->with('success_status', 'Campaign updated successfully.');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect(route('campaign_update.get', $id))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}