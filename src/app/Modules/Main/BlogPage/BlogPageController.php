<?php

namespace App\Modules\Main\BlogPage;

use App\Http\Controllers\Controller;
use App\Modules\Legal\Services\LegalService;
use App\Modules\Blog\Services\BlogService;
use App\Modules\Seo\Services\SeoService;
use App\Modules\Settings\Services\ChatbotService;
use App\Modules\Settings\Services\GeneralService;
use App\Modules\Settings\Services\ThemeService;
use Illuminate\Http\Request;

class BlogPageController extends Controller
{
    private $seoService;
    private $generalService;
    private $themeService;
    private $chatbotService;
    private $blogService;
    private $legalService;

    public function __construct(
        SeoService $seoService,
        GeneralService $generalService,
        ThemeService $themeService,
        ChatbotService $chatbotService,
        BlogService $blogService,
        LegalService $legalService,
    )
    {
        $this->seoService = $seoService;
        $this->generalService = $generalService;
        $this->themeService = $themeService;
        $this->chatbotService = $chatbotService;
        $this->blogService = $blogService;
        $this->legalService = $legalService;
    }

    public function get(Request $request){
        $seo = $this->seoService->getBySlugMain('blog-page');
        $generalSetting = $this->generalService->getById(1);
        $themeSetting = $this->themeService->getById(1);
        $blogs = $this->blogService->main_paginate($request->total ?? 10);
        $legal = $this->legalService->main_all();
        return view('main.pages.blogs.index', compact([
            'seo',
            'generalSetting',
            'themeSetting',
            'blogs',
            'legal'
        ]));
    }

}
