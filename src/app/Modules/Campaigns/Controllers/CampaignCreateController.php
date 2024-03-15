<?php

namespace App\Modules\Campaigns\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Requests\CampaignCreateRequest;
use App\Modules\Campaigns\Services\CampaignService;

class CampaignCreateController extends Controller
{
    private $campaignService;

    public function __construct(CampaignService $campaignService)
    {
        $this->middleware('permission:campaigns', ['only' => ['get','post']]);
        $this->campaignService = $campaignService;
    }

    public function get(){
        return view('admin.pages.campaigns.create');
    }

    public function post(CampaignCreateRequest $request){

        try {
            //code...
            $this->campaignService->create($request);
            return redirect()->intended(route('campaign_create.get'))->with('success_status', 'Campaign created successfully.');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect(route('campaign_create.get'))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}