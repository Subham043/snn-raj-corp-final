<?php

namespace App\Modules\Campaigns\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Services\CampaignService;

class CampaignViewMainController extends Controller
{
    private $campaignService;

    public function __construct(CampaignService $campaignService)
    {
        $this->campaignService = $campaignService;
    }

    public function get($slug){
        $data = $this->campaignService->getBySlug($slug);
        $userAgent = request()->header('User-Agent');

        $isMobile = preg_match(
            '/iPhone|iPod|Android|BlackBerry|Opera Mini|IEMobile|WPDesktop|Mobile|Tablet/i',
            $userAgent
        );
        return view('main.pages.campaign.index')->with('data', $data)->with('isMobile', $isMobile);
    }

    public function thank($slug){
        $data = $this->campaignService->getBySlug($slug);
        // return $data;
        return view('main.pages.campaign.thank')->with('data', $data);
    }
}
