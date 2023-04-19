<?php

namespace App\Modules\Main\AboutPage;

use App\Http\Controllers\Controller;
use App\Modules\About\AdditionalContent\Services\AdditionalContentService;
use App\Modules\About\Banner\Services\BannerService;
use App\Modules\About\Main\Services\MainService;

class AboutPageController extends Controller
{
    private $bannerService;

    public function __construct(
        BannerService $bannerService,
        MainService $mainService,
        AdditionalContentService $additionalContentService
    )
    {
        $this->bannerService = $bannerService;
        $this->mainService = $mainService;
        $this->additionalContentService = $additionalContentService;
    }

    public function get(){
        $banner = $this->bannerService->getById(1);
        $about = $this->mainService->getById(1);
        $additionalContent = $this->additionalContentService->main_all();
        return view('main.pages.about', compact(['banner', 'about', 'additionalContent']));
    }

}
