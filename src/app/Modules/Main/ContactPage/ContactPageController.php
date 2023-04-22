<?php

namespace App\Modules\Main\ContactPage;

use App\Http\Controllers\Controller;
use App\Modules\Seo\Services\SeoService;
use App\Modules\Settings\Services\GeneralService;

class ContactPageController extends Controller
{
    private $seoService;
    private $generalService;

    public function __construct(
        SeoService $seoService,
        GeneralService $generalService
    )
    {
        $this->seoService = $seoService;
        $this->generalService = $generalService;
    }

    public function get(){
        $seo = $this->seoService->getBySlugMain('contact-page');
        $generalSetting = $this->generalService->getById(1);
        return view('main.pages.contact', compact(['seo', 'generalSetting']));
    }

}
