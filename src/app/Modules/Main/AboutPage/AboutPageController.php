<?php

namespace App\Modules\Main\AboutPage;

use App\Http\Controllers\Controller;
use App\Modules\About\AdditionalContent\Services\AdditionalContentService;
use App\Modules\About\Banner\Services\BannerService;
use App\Modules\About\Main\Services\MainService;
use App\Modules\Legal\Services\LegalService;
use App\Modules\Partner\Services\PartnerHeadingService;
use App\Modules\Partner\Services\PartnerService;
use App\Modules\Project\Projects\Services\ProjectService;
use App\Modules\Seo\Services\SeoService;
use App\Modules\Settings\Services\ChatbotService;
use App\Modules\Settings\Services\GeneralService;
use App\Modules\Settings\Services\ThemeService;
use App\Modules\TeamMember\Management\Services\ManagementHeadingService;
use App\Modules\TeamMember\Management\Services\ManagementService;
use App\Modules\TeamMember\Staff\Services\StaffHeadingService;
use App\Modules\TeamMember\Staff\Services\StaffService;

class AboutPageController extends Controller
{
    private $bannerService;
    private $mainService;
    private $additionalContentService;
    private $seoService;
    private $managementService;
    private $managementHeadingService;
    private $staffService;
    private $staffHeadingService;
    private $partnerService;
    private $partnerHeadingService;
    private $generalService;
    private $themeService;
    private $chatbotService;
    private $legalService;
    private $projectService;

    public function __construct(
        BannerService $bannerService,
        MainService $mainService,
        AdditionalContentService $additionalContentService,
        ManagementService $managementService,
        ManagementHeadingService $managementHeadingService,
        StaffService $staffService,
        StaffHeadingService $staffHeadingService,
        PartnerService $partnerService,
        PartnerHeadingService $partnerHeadingService,
        SeoService $seoService,
        GeneralService $generalService,
        ThemeService $themeService,
        ChatbotService $chatbotService,
        LegalService $legalService,
        ProjectService $projectService,
    )
    {
        $this->bannerService = $bannerService;
        $this->mainService = $mainService;
        $this->additionalContentService = $additionalContentService;
        $this->seoService = $seoService;
        $this->managementService = $managementService;
        $this->managementHeadingService = $managementHeadingService;
        $this->staffService = $staffService;
        $this->staffHeadingService = $staffHeadingService;
        $this->partnerService = $partnerService;
        $this->partnerHeadingService = $partnerHeadingService;
        $this->generalService = $generalService;
        $this->themeService = $themeService;
        $this->chatbotService = $chatbotService;
        $this->legalService = $legalService;
        $this->projectService = $projectService;
    }

    public function get(){
        $banner = $this->bannerService->getById(1);
        $about = $this->mainService->getById(1);
        $additionalContent = $this->additionalContentService->main_all();
        $legal = $this->legalService->main_all();
        $management = $this->managementService->main_all();
        $staffs = $this->staffService->main_all();
        $managementHeading = $this->managementHeadingService->getById(1);
        $staffHeading = $this->staffHeadingService->getById(1);
        $partners = $this->partnerService->main_all();
        $partnerHeading = $this->partnerHeadingService->getById(1);
        $seo = $this->seoService->getBySlugMain('about-page');
        $generalSetting = $this->generalService->getById(1);
        $themeSetting = $this->themeService->getById(1);
        $projects = $this->projectService->main_listing();
        return view('main.pages.about', compact(['banner', 'about', 'additionalContent', 'seo', 'staffs', 'management', 'managementHeading', 'staffHeading', 'partners', 'partnerHeading', 'generalSetting', 'themeSetting', 'legal', 'projects']));
    }

    public function slug($slug){
        $generalSetting = $this->generalService->getById(1);
        $themeSetting = $this->themeService->getById(1);
        $legal = $this->legalService->main_all();
        $data = $this->additionalContentService->main_by_slug($slug);
        return view('main.pages.about_slug', compact([
            'generalSetting',
            'themeSetting',
            'data',
            'legal',
        ]));
    }

}
