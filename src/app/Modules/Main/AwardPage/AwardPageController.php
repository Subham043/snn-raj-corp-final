<?php

namespace App\Modules\Main\AwardPage;

use App\Http\Controllers\Controller;
use App\Modules\Awards\Services\AwardHeadingService;
use App\Modules\Awards\Services\AwardService;
use App\Modules\Seo\Services\SeoService;
use App\Modules\Settings\Services\GeneralService;
use App\Modules\Settings\Services\ThemeService;
use Illuminate\Http\Request;

class AwardPageController extends Controller
{
    private $awardService;
    private $awardHeadingService;
    private $seoService;
    private $generalService;
    private $themeService;

    public function __construct(
        AwardService $awardService,
        AwardHeadingService $awardHeadingService,
        SeoService $seoService,
        GeneralService $generalService,
        ThemeService $themeService,
    )
    {
        $this->awardService = $awardService;
        $this->awardHeadingService = $awardHeadingService;
        $this->seoService = $seoService;
        $this->generalService = $generalService;
        $this->themeService = $themeService;
    }

    public function get(Request $request){
        $awards = $this->awardService->main_paginate($request->total ?? 10);
        $awardHeading = $this->awardHeadingService->getById(1);
        $seo = $this->seoService->getBySlugMain('award-page');
        $generalSetting = $this->generalService->getById(1);
        $themeSetting = $this->themeService->getById(1);
        return view('main.pages.award', compact(['awards', 'seo', 'awardHeading', 'generalSetting', 'themeSetting']));
    }

}
