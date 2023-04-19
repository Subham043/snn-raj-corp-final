<?php

namespace App\Modules\Main\AboutPage;

use App\Http\Controllers\Controller;
use App\Modules\About\AdditionalContent\Services\AdditionalContentService;
use App\Modules\About\Banner\Services\BannerService;
use App\Modules\About\Main\Services\MainService;
use App\Modules\Seo\Services\SeoService;

class AboutPageController extends Controller
{
    private $bannerService;
    private $mainService;
    private $additionalContentService;
    private $seoService;

    public function __construct(
        BannerService $bannerService,
        MainService $mainService,
        AdditionalContentService $additionalContentService,
        SeoService $seoService
    )
    {
        $this->bannerService = $bannerService;
        $this->mainService = $mainService;
        $this->additionalContentService = $additionalContentService;
        $this->seoService = $seoService;
    }

    public function get(){
        $banner = $this->bannerService->getById(1);
        $about = $this->mainService->getById(1);
        $additionalContent = $this->additionalContentService->main_all();
        $seo = $this->seoService->getBySlugMain('about-page');
        return view('main.pages.about', compact(['banner', 'about', 'additionalContent', 'seo']));
    }

}
