<?php

namespace App\Modules\Main\AwardPage;

use App\Http\Controllers\Controller;
use App\Modules\Awards\Services\AwardHeadingService;
use App\Modules\Awards\Services\AwardService;
use App\Modules\Legal\Services\LegalService;
use App\Modules\Project\Projects\Services\ProjectService;
use App\Modules\Seo\Services\SeoService;
use App\Modules\Settings\Services\ChatbotService;
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
    private $chatbotService;
    private $legalService;
    private $projectService;

    public function __construct(
        AwardService $awardService,
        AwardHeadingService $awardHeadingService,
        SeoService $seoService,
        GeneralService $generalService,
        ThemeService $themeService,
        ChatbotService $chatbotService,
        LegalService $legalService,
        ProjectService $projectService,
    )
    {
        $this->awardService = $awardService;
        $this->awardHeadingService = $awardHeadingService;
        $this->seoService = $seoService;
        $this->generalService = $generalService;
        $this->themeService = $themeService;
        $this->chatbotService = $chatbotService;
        $this->legalService = $legalService;
        $this->projectService = $projectService;
    }

    public function get(Request $request){
        $awards = $this->awardService->main_paginate($request->total ?? 10);
        $awardHeading = $this->awardHeadingService->getById(1);
        $seo = $this->seoService->getBySlugMain('award-page');
        $generalSetting = $this->generalService->getById(1);
        $themeSetting = $this->themeService->getById(1);
        $chatbotSetting = $this->chatbotService->getById(1);
        $legal = $this->legalService->main_all();
        $projects = $this->projectService->main_all();
        return view('main.pages.award', compact(['projects', 'awards', 'seo', 'awardHeading', 'generalSetting', 'themeSetting', 'chatbotSetting', 'legal']));
    }

}
