<?php

namespace App\Modules\Main\ProjectPage;

use App\Http\Controllers\Controller;
use App\Modules\Legal\Services\LegalService;
use App\Modules\Project\Projects\Services\ProjectService;
use App\Modules\Seo\Services\SeoService;
use App\Modules\Settings\Services\ChatbotService;
use App\Modules\Settings\Services\GeneralService;
use App\Modules\Settings\Services\ThemeService;
use App\Modules\Project\Projects\Services\ProjectHeadingService;
use Illuminate\Http\Request;

class ProjectPageController extends Controller
{
    private $seoService;
    private $generalService;
    private $themeService;
    private $chatbotService;
    private $projectService;
    private $legalService;
    private $projectHeadingService;

    public function __construct(
        SeoService $seoService,
        GeneralService $generalService,
        ThemeService $themeService,
        ChatbotService $chatbotService,
        ProjectService $projectService,
        LegalService $legalService,
        ProjectHeadingService $projectHeadingService,
    )
    {
        $this->seoService = $seoService;
        $this->generalService = $generalService;
        $this->themeService = $themeService;
        $this->chatbotService = $chatbotService;
        $this->projectService = $projectService;
        $this->legalService = $legalService;
        $this->projectHeadingService = $projectHeadingService;
    }

    public function get(Request $request){
        $seo = $this->seoService->getBySlugMain('project-completed-page');
        $generalSetting = $this->generalService->getById(1);
        $themeSetting = $this->themeService->getById(1);
        $chatbotSetting = $this->chatbotService->getById(1);
        $projectHeading = $this->projectHeadingService->getById(1);
        $projects = $this->projectService->main_paginate_all($request->total ?? 10);
        $legal = $this->legalService->main_all();
        return view('main.pages.projects.list', compact([
            'seo',
            'generalSetting',
            'themeSetting',
            'chatbotSetting',
            'projects',
            'projectHeading',
            'legal'
        ]));
    }

}
