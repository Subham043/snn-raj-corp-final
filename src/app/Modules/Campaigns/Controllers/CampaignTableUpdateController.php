<?php

namespace App\Modules\Campaigns\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Requests\CampaignTableRequest;
use App\Modules\Campaigns\Services\CampaignTableService;

class CampaignTableUpdateController extends Controller
{
    private $campaignTableService;

    public function __construct(CampaignTableService $campaignTableService)
    {
        $this->middleware('permission:campaigns', ['only' => ['get','post']]);
        $this->campaignTableService = $campaignTableService;
    }

    public function get(Int $campaign_id, Int $id){
        $data = $this->campaignTableService->getById($id);
        return view('admin.pages.campaigns.table.update')->with(
            [
                'data' => $data,
                'campaign_id' => $campaign_id,
            ]
        );
    }

    public function post(CampaignTableRequest $request, Int $campaign_id,  Int $id){
        $data = $this->campaignTableService->getById($id);
        try {
            //code...
            $this->campaignTableService->update($request, $data);
            return redirect()->intended(route('campaign_table_update.get', [$campaign_id, $id]))->with('success_status', 'Campaign Table Data updated successfully.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect(route('campaign_table_update.get', [$campaign_id, $id]))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}
