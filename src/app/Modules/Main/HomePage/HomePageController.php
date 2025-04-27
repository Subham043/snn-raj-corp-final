<?php

namespace App\Modules\Main\HomePage;

use App\Http\Controllers\Controller;
use App\Modules\Awards\Services\AwardService;
use App\Modules\Blog\Services\BlogService;
use App\Modules\Counter\Services\CounterHeadingService;
use App\Modules\Counter\Services\CounterService;
use App\Modules\HomePage\About\Services\AboutService;
use App\Modules\HomePage\Banner\Services\BannerService;
use App\Modules\HomePage\Testimonial\Services\TestimonialHeadingService;
use App\Modules\HomePage\Testimonial\Services\TestimonialService;
use App\Modules\Legal\Services\LegalService;
use App\Modules\Project\Projects\Services\ProjectHeadingService;
use App\Modules\Project\Projects\Services\ProjectService;
use App\Modules\Seo\Services\SeoService;
use App\Modules\Settings\Services\ChatbotService;
use App\Modules\Settings\Services\GeneralService;
use App\Modules\Settings\Services\ThemeService;

class HomePageController extends Controller
{
    private $bannerService;
    private $blogService;
    private $aboutService;
    private $testimonialService;
    private $counterService;
    private $projectService;
    private $legalService;
    private $seoService;
    private $counterHeadingService;
    private $testimonialHeadingService;
    private $projectHeadingService;
    private $generalService;
    private $themeService;
    private $chatbotService;

    public function __construct(
        BlogService $blogService,
        BannerService $bannerService,
        AboutService $aboutService,
        TestimonialService $testimonialService,
        CounterService $counterService,
        SeoService $seoService,
        CounterHeadingService $counterHeadingService,
        TestimonialHeadingService $testimonialHeadingService,
        ProjectHeadingService $projectHeadingService,
        GeneralService $generalService,
        ThemeService $themeService,
        ChatbotService $chatbotService,
        ProjectService $projectService,
        LegalService $legalService,
        private AwardService $awardService,
    )
    {
        $this->bannerService = $bannerService;
        $this->blogService = $blogService;
        $this->aboutService = $aboutService;
        $this->testimonialService = $testimonialService;
        $this->counterService = $counterService;
        $this->seoService = $seoService;
        $this->counterHeadingService = $counterHeadingService;
        $this->testimonialHeadingService = $testimonialHeadingService;
        $this->projectHeadingService = $projectHeadingService;
        $this->generalService = $generalService;
        $this->themeService = $themeService;
        $this->chatbotService = $chatbotService;
        $this->projectService = $projectService;
        $this->legalService = $legalService;
    }

    public function get(){
        $banners = $this->bannerService->main_all();
        $blogs = $this->blogService->main_all();
        $about = $this->aboutService->getById(1);
        $testimonials = $this->testimonialService->main_all();
        $counters = $this->counterService->main_all();
        $projects = $this->projectService->main_all();
        $display_projects = $this->projectService->home_main_all();
        $legal = $this->legalService->main_all();
        $counterHeading = $this->counterHeadingService->getById(1);
        $testimonialHeading = $this->testimonialHeadingService->getById(1);
        $projectHeading = $this->projectHeadingService->getById(1);
        $seo = $this->seoService->getBySlugMain('home-page');
        $generalSetting = $this->generalService->getById(1);
        $themeSetting = $this->themeService->getById(1);
        $chatbotSetting = $this->chatbotService->getById(1);
        $awards = $this->awardService->latestLimit();
        return view('main.pages.index', compact([
            'banners',
            'blogs',
            'about',
            'testimonials',
            'counters',
            'projects',
            'display_projects',
            'legal',
            'seo',
            'counterHeading',
            'testimonialHeading',
            'projectHeading',
            'generalSetting',
            'themeSetting',
            'chatbotSetting',
            'awards',
        ]));
    }

}
