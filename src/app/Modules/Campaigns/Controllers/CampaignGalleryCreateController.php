<?php

namespace App\Modules\Campaigns\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Services\CampaignService;
use App\Modules\Campaigns\Requests\CampaignGalleryCreateRequest;
use App\Modules\Campaigns\Services\CampaignGalleryService;

class CampaignGalleryCreateController extends Controller
{
    private $campaignService;
    private $campaignGalleryService;

    public function __construct(CampaignGalleryService $campaignGalleryService, CampaignService $campaignService)
    {
        $this->middleware('permission:campaigns', ['only' => ['get','post']]);
        $this->campaignService = $campaignService;
        $this->campaignGalleryService = $campaignGalleryService;
    }

    public function get(Int $campaign_id){
        $this->campaignService->getById($campaign_id);
        return view('admin.pages.campaigns.gallery.create')->with(
            [
                'campaign_id' => $campaign_id
            ]
        );
    }

    public function post(CampaignGalleryCreateRequest $request, Int $campaign_id){
        $this->campaignService->getById($campaign_id);
        try {
            //code...
            $this->campaignGalleryService->create($request, $campaign_id);
            return redirect()->intended(route('campaign_gallery_create.get', $campaign_id))->with('success_status', 'Campaign Gallery Image created successfully.');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect(route('campaign_gallery_create.get', $campaign_id))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}