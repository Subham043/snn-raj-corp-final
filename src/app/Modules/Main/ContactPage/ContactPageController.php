<?php

namespace App\Modules\Main\ContactPage;

use App\Http\Controllers\Controller;
use App\Modules\Seo\Services\SeoService;
use App\Modules\Settings\Services\GeneralService;
use App\Modules\Settings\Services\ThemeService;

class ContactPageController extends Controller
{
    private $seoService;
    private $generalService;
    private $themeService;

    public function __construct(
        SeoService $seoService,
        GeneralService $generalService,
        ThemeService $themeService,
    )
    {
        $this->seoService = $seoService;
        $this->generalService = $generalService;
        $this->themeService = $themeService;
    }

    public function get(){
        $seo = $this->seoService->getBySlugMain('contact-page');
        $generalSetting = $this->generalService->getById(1);
        $themeSetting = $this->themeService->getById(1);
        return view('main.pages.contact', compact(['seo', 'generalSetting', 'themeSetting']));
    }

}
