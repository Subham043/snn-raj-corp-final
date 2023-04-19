<?php

namespace App\Modules\Main\AboutPage;

use App\Http\Controllers\Controller;
use App\Modules\About\AdditionalContent\Services\AdditionalContentService;
use App\Modules\About\Banner\Services\BannerService;
use App\Modules\About\Main\Services\MainService;
use App\Modules\Seo\Services\SeoService;
use App\Modules\TeamMember\Management\Services\ManagementService;
use App\Modules\TeamMember\Staff\Services\StaffService;

class AboutPageController extends Controller
{
    private $bannerService;
    private $mainService;
    private $additionalContentService;
    private $seoService;
    private $managementService;
    private $staffService;

    public function __construct(
        BannerService $bannerService,
        MainService $mainService,
        AdditionalContentService $additionalContentService,
        ManagementService $managementService,
        StaffService $staffService,
        SeoService $seoService
    )
    {
        $this->bannerService = $bannerService;
        $this->mainService = $mainService;
        $this->additionalContentService = $additionalContentService;
        $this->seoService = $seoService;
        $this->managementService = $managementService;
        $this->staffService = $staffService;
    }

    public function get(){
        $banner = $this->bannerService->getById(1);
        $about = $this->mainService->getById(1);
        $additionalContent = $this->additionalContentService->main_all();
        $management = $this->managementService->main_all();
        $staffs = $this->staffService->main_all();
        $seo = $this->seoService->getBySlugMain('about-page');
        return view('main.pages.about', compact(['banner', 'about', 'additionalContent', 'seo', 'staffs', 'management']));
    }

}
