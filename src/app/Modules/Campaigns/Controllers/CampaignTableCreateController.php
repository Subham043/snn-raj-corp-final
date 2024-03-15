<?php

namespace App\Modules\Campaigns\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Services\CampaignService;
use App\Modules\Campaigns\Requests\CampaignTableRequest;
use App\Modules\Campaigns\Services\CampaignTableService;

class CampaignTableCreateController extends Controller
{
    private $campaignService;
    private $campaignTableService;

    public function __construct(CampaignTableService $campaignTableService, CampaignService $campaignService)
    {
        $this->middleware('permission:campaigns', ['only' => ['get','post']]);
        $this->campaignService = $campaignService;
        $this->campaignTableService = $campaignTableService;
    }

    public function get(Int $campaign_id){
        $this->campaignService->getById($campaign_id);
        return view('admin.pages.campaigns.table.create')->with(
            [
                'campaign_id' => $campaign_id
            ]
        );
    }

    public function post(CampaignTableRequest $request, Int $campaign_id){
        $this->campaignService->getById($campaign_id);
        try {
            //code...
            $this->campaignTableService->create($request, $campaign_id);
            return redirect()->intended(route('campaign_table_create.get', $campaign_id))->with('success_status', 'Campaign Table Data created successfully.');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect(route('campaign_table_create.get', $campaign_id))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}