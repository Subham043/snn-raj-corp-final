<?php

namespace App\Modules\Campaigns\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Services\CampaignService;

class CampaignDeleteController extends Controller
{
    private $campaignService;

    public function __construct(CampaignService $campaignService)
    {
        $this->middleware('permission:campaigns', ['only' => ['get','post']]);
        $this->campaignService = $campaignService;
    }

    public function get(Int $id){
        $data = $this->campaignService->getById($id);
        try {
            //code...
            $this->campaignService->delete($data);
            return redirect()->intended(route('campaign_list.get'))->with('success_status', 'Campaign deleted successfully.');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect(route('campaign_list.get'))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }
    }
}