<?php

namespace App\Modules\Main\CsrPage;

use App\Http\Controllers\Controller;
use App\Modules\Csr\Services\CsrBannerService;
use App\Modules\Csr\Services\CsrService;
use App\Modules\Seo\Services\SeoService;

class CsrPageController extends Controller
{
    private $csrBannerService;
    private $csrService;
    private $seoService;

    public function __construct(
        CsrBannerService $csrBannerService,
        CsrService $csrService,
        SeoService $seoService
    )
    {
        $this->csrBannerService = $csrBannerService;
        $this->csrService = $csrService;
        $this->seoService = $seoService;
    }

    public function get(){
        $banner = $this->csrBannerService->getById(1);
        $mainContent = $this->csrService->main_all();
        $seo = $this->seoService->getBySlugMain('csr-page');
        return view('main.pages.csr', compact(['banner', 'mainContent', 'seo']));
    }

}
