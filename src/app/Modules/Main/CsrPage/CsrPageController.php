<?php

namespace App\Modules\Main\CsrPage;

use App\Http\Controllers\Controller;
use App\Modules\Csr\Services\CsrBannerService;
use App\Modules\Csr\Services\CsrService;
use App\Modules\Seo\Services\SeoService;
use App\Modules\Settings\Services\GeneralService;

class CsrPageController extends Controller
{
    private $csrBannerService;
    private $csrService;
    private $seoService;
    private $generalService;

    public function __construct(
        CsrBannerService $csrBannerService,
        CsrService $csrService,
        SeoService $seoService,
        GeneralService $generalService
    )
    {
        $this->csrBannerService = $csrBannerService;
        $this->csrService = $csrService;
        $this->seoService = $seoService;
        $this->generalService = $generalService;
    }

    public function get(){
        $banner = $this->csrBannerService->getById(1);
        $mainContent = $this->csrService->main_all();
        $seo = $this->seoService->getBySlugMain('csr-page');
        $generalSetting = $this->generalService->getById(1);
        return view('main.pages.csr', compact(['banner', 'mainContent', 'seo', 'generalSetting']));
    }

}
