<?php

namespace App\Modules\Main\CsrPage;

use App\Http\Controllers\Controller;
use App\Modules\Csr\Services\CsrBannerService;
use App\Modules\Csr\Services\CsrService;
use App\Modules\Legal\Services\LegalService;
use App\Modules\Seo\Services\SeoService;
use App\Modules\Settings\Services\ChatbotService;
use App\Modules\Settings\Services\GeneralService;
use App\Modules\Settings\Services\ThemeService;

class CsrPageController extends Controller
{
    private $csrBannerService;
    private $csrService;
    private $seoService;
    private $generalService;
    private $themeService;
    private $chatbotService;
    private $legalService;

    public function __construct(
        CsrBannerService $csrBannerService,
        CsrService $csrService,
        SeoService $seoService,
        GeneralService $generalService,
        ThemeService $themeService,
        ChatbotService $chatbotService,
        LegalService $legalService,
    )
    {
        $this->csrBannerService = $csrBannerService;
        $this->csrService = $csrService;
        $this->seoService = $seoService;
        $this->generalService = $generalService;
        $this->themeService = $themeService;
        $this->chatbotService = $chatbotService;
        $this->legalService = $legalService;
    }

    public function get(){
        $banner = $this->csrBannerService->getById(1);
        $mainContent = $this->csrService->main_all();
        $legal = $this->legalService->main_all();
        $seo = $this->seoService->getBySlugMain('csr-page');
        $generalSetting = $this->generalService->getById(1);
        $themeSetting = $this->themeService->getById(1);
        $chatbotSetting = $this->chatbotService->getById(1);
        return view('main.pages.csr', compact(['banner', 'mainContent', 'seo', 'generalSetting', 'themeSetting', 'chatbotSetting', 'legal']));
    }

}
