<?php

namespace App\Modules\Main\LandOwnerPage;

use App\Http\Controllers\Controller;
use App\Modules\Legal\Services\LegalService;
use App\Modules\Seo\Services\SeoService;
use App\Modules\Settings\Services\ChatbotService;
use App\Modules\Settings\Services\GeneralService;
use App\Modules\Settings\Services\ThemeService;

class LandOwnerPageController extends Controller
{
    private $seoService;
    private $generalService;
    private $themeService;
    private $chatbotService;
    private $legalService;

    public function __construct(
        SeoService $seoService,
        GeneralService $generalService,
        ThemeService $themeService,
        ChatbotService $chatbotService,
        LegalService $legalService,
    )
    {
        $this->seoService = $seoService;
        $this->generalService = $generalService;
        $this->themeService = $themeService;
        $this->chatbotService = $chatbotService;
        $this->legalService = $legalService;
    }

    public function get(){
        $seo = $this->seoService->getBySlugMain('land-owner-page');
        $generalSetting = $this->generalService->getById(1);
        $themeSetting = $this->themeService->getById(1);
        $chatbotSetting = $this->chatbotService->getById(1);
        $legal = $this->legalService->main_all();
        return view('main.pages.land_owner', compact(['seo', 'generalSetting', 'themeSetting', 'chatbotSetting', 'legal']));
    }

}
