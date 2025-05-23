<?php

namespace App\Modules\Main\ProjectPage;

use App\Http\Controllers\Controller;
use App\Modules\Legal\Services\LegalService;
use App\Modules\Project\Projects\Services\ProjectService;
use App\Modules\Seo\Services\SeoService;
use App\Modules\Settings\Services\ChatbotService;
use App\Modules\Settings\Services\GeneralService;
use App\Modules\Settings\Services\ThemeService;
use Illuminate\Http\Request;

class CompletedProjectPageController extends Controller
{
    private $seoService;
    private $generalService;
    private $themeService;
    private $chatbotService;
    private $projectService;
    private $legalService;

    public function __construct(
        SeoService $seoService,
        GeneralService $generalService,
        ThemeService $themeService,
        ChatbotService $chatbotService,
        ProjectService $projectService,
        LegalService $legalService,
    )
    {
        $this->seoService = $seoService;
        $this->generalService = $generalService;
        $this->themeService = $themeService;
        $this->chatbotService = $chatbotService;
        $this->projectService = $projectService;
        $this->legalService = $legalService;
    }

    public function get(Request $request){
        $seo = $this->seoService->getBySlugMain('project-completed-page');
        $generalSetting = $this->generalService->getById(1);
        $themeSetting = $this->themeService->getById(1);
        $projects = $this->projectService->main_paginate_all(true);
        $legal = $this->legalService->main_all();
        $status = 'completed';
        return view('main.pages.projects.index', compact([
            'seo',
            'generalSetting',
            'themeSetting',
            'projects',
            'status',
            'legal'
        ]));
    }

}
