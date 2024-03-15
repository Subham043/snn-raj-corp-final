<?php

namespace App\Modules\Campaigns\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Services\CampaignTableService;

class CampaignTableDeleteController extends Controller
{
    private $campaignTableService;

    public function __construct(CampaignTableService $campaignTableService)
    {
        $this->middleware('permission:campaigns', ['only' => ['get','post']]);
        $this->campaignTableService = $campaignTableService;
    }

    public function get(Int $campaign_id, Int $id){
        $data = $this->campaignTableService->getById($id);
        try {
            //code...
            $this->campaignTableService->delete($data);
            return redirect()->intended(route('campaign_table_list.get', $campaign_id))->with('success_status', 'Campaign Table Data deleted successfully.');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect(route('campaign_table_list.get', $campaign_id))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }
    }
}