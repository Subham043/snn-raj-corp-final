<?php

namespace App\Modules\Campaigns\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Services\CampaignGalleryService;

class CampaignGalleryDeleteController extends Controller
{
    private $campaignGalleryService;

    public function __construct(CampaignGalleryService $campaignGalleryService)
    {
        $this->middleware('permission:campaigns', ['only' => ['get','post']]);
        $this->campaignGalleryService = $campaignGalleryService;
    }

    public function get(Int $campaign_id, Int $id){
        $data = $this->campaignGalleryService->getById($id);
        try {
            //code...
            $this->campaignGalleryService->delete($data);
            return redirect()->intended(route('campaign_gallery_list.get', $campaign_id))->with('success_status', 'Campaign Gallery Image deleted successfully.');
        } catch (\Throwable $th) {
            throw $th;
            return redirect(route('campaign_gallery_list.get', $campaign_id))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }
    }
}
