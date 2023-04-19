<?php

namespace App\Modules\Main\ContactPage;

use App\Http\Controllers\Controller;
use App\Modules\Seo\Services\SeoService;

class ContactPageController extends Controller
{
    private $seoService;

    public function __construct(
        SeoService $seoService
    )
    {
        $this->seoService = $seoService;
    }

    public function get(){
        $seo = $this->seoService->getBySlugMain('contact-page');
        return view('main.pages.contact', compact(['seo']));
    }

}
