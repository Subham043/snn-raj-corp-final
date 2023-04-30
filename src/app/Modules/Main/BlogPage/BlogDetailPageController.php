<?php

namespace App\Modules\Main\BlogPage;

use App\Http\Controllers\Controller;
use App\Modules\Legal\Services\LegalService;
use App\Modules\Blog\Services\BlogService;
use App\Modules\Settings\Services\ChatbotService;
use App\Modules\Settings\Services\GeneralService;
use App\Modules\Settings\Services\ThemeService;

class BlogDetailPageController extends Controller
{
    private $generalService;
    private $themeService;
    private $chatbotService;
    private $blogService;
    private $legalService;

    public function __construct(
        GeneralService $generalService,
        ThemeService $themeService,
        ChatbotService $chatbotService,
        BlogService $blogService,
        LegalService $legalService,
    )
    {
        $this->generalService = $generalService;
        $this->themeService = $themeService;
        $this->chatbotService = $chatbotService;
        $this->blogService = $blogService;
        $this->legalService = $legalService;
    }

    public function get($slug){
        $generalSetting = $this->generalService->getById(1);
        $themeSetting = $this->themeService->getById(1);
        $chatbotSetting = $this->chatbotService->getById(1);
        $legal = $this->legalService->main_all();
        $data = $this->blogService->getBySlugMain($slug);
        $next = $this->blogService->getNext($data->id);
        $prev = $this->blogService->getPrev($data->id);
        return view('main.pages.blogs.detail', compact([
            'generalSetting',
            'themeSetting',
            'chatbotSetting',
            'data',
            'next',
            'prev',
            'legal',
        ]));
    }

}
