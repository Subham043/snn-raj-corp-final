<?php

namespace App\Modules\Main\ProjectPage;

use App\Http\Controllers\Controller;
use App\Modules\Legal\Services\LegalService;
use App\Modules\Project\Projects\Services\ProjectService;
use App\Modules\Settings\Services\ChatbotService;
use App\Modules\Settings\Services\GeneralService;
use App\Modules\Settings\Services\ThemeService;

class ProjectDetailPageController extends Controller
{
    private $generalService;
    private $themeService;
    private $chatbotService;
    private $projectService;
    private $legalService;

    public function __construct(
        GeneralService $generalService,
        ThemeService $themeService,
        ChatbotService $chatbotService,
        ProjectService $projectService,
        LegalService $legalService,
    )
    {
        $this->generalService = $generalService;
        $this->themeService = $themeService;
        $this->chatbotService = $chatbotService;
        $this->projectService = $projectService;
        $this->legalService = $legalService;
    }

    public function get($slug){
        $generalSetting = $this->generalService->getById(1);
        $themeSetting = $this->themeService->getById(1);
        $chatbotSetting = $this->chatbotService->getById(1);
        $legal = $this->legalService->main_all();
        $data = $this->projectService->getBySlugMain($slug);
        return view('main.pages.projects.detail', compact([
            'generalSetting',
            'themeSetting',
            'chatbotSetting',
            'data',
            'legal',
        ]));
    }

}
