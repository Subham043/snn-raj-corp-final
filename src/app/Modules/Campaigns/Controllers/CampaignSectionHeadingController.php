<?php

namespace App\Modules\Campaigns\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Requests\CampaignSectionHeadingRequest;
use App\Modules\Campaigns\Services\CampaignService;
use Illuminate\Support\Facades\URL;

class CampaignSectionHeadingController extends Controller
{
    private $campaignService;

    public function __construct(CampaignService $campaignService)
    {
        $this->middleware('permission:campaigns', ['only' => ['get','post']]);
        $this->campaignService = $campaignService;
    }

    public function post(CampaignSectionHeadingRequest $request, Int $campaign_id){
        $campaign = $this->campaignService->getById($campaign_id);
        try {
            //code...
            $this->campaignService->updateHeading([$request->key => $request->heading], $campaign);
            return redirect()->intended(URL::previous())->with('success_status', 'Heading saved successfully.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect(URL::previous())->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}
