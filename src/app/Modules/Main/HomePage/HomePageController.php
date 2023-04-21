<?php

namespace App\Modules\Main\HomePage;

use App\Http\Controllers\Controller;
use App\Modules\Counter\Services\CounterHeadingService;
use App\Modules\Counter\Services\CounterService;
use App\Modules\HomePage\About\Services\AboutService;
use App\Modules\HomePage\Banner\Services\BannerService;
use App\Modules\HomePage\Testimonial\Services\TestimonialHeadingService;
use App\Modules\HomePage\Testimonial\Services\TestimonialService;
use App\Modules\Seo\Services\SeoService;

class HomePageController extends Controller
{
    private $bannerService;
    private $aboutService;
    private $testimonialService;
    private $counterService;
    private $seoService;
    private $counterHeadingService;
    private $testimonialHeadingService;

    public function __construct(
        BannerService $bannerService,
        AboutService $aboutService,
        TestimonialService $testimonialService,
        CounterService $counterService,
        SeoService $seoService,
        CounterHeadingService $counterHeadingService,
        TestimonialHeadingService $testimonialHeadingService,
    )
    {
        $this->bannerService = $bannerService;
        $this->aboutService = $aboutService;
        $this->testimonialService = $testimonialService;
        $this->counterService = $counterService;
        $this->seoService = $seoService;
        $this->counterHeadingService = $counterHeadingService;
        $this->testimonialHeadingService = $testimonialHeadingService;
    }

    public function get(){
        $banners = $this->bannerService->main_all();
        $about = $this->aboutService->getById(1);
        $testimonials = $this->testimonialService->main_all();
        $counters = $this->counterService->main_all();
        $counterHeading = $this->counterHeadingService->getById(1);
        $testimonialHeading = $this->testimonialHeadingService->getById(1);
        $seo = $this->seoService->getBySlugMain('home-page');
        return view('main.pages.index', compact([
            'banners',
            'about',
            'testimonials',
            'counters',
            'seo',
            'counterHeading',
            'testimonialHeading'
        ]));
    }

}
