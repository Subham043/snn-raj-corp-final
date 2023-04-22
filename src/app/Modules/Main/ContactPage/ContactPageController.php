<?php

namespace App\Modules\Main\ContactPage;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\ContactForm\Requests\ContactFormRequest;
use App\Modules\Enquiry\ContactForm\Services\ContactFormService;
use App\Modules\Seo\Services\SeoService;
use App\Modules\Settings\Services\GeneralService;
use App\Modules\Settings\Services\ThemeService;

class ContactPageController extends Controller
{
    private $seoService;
    private $generalService;
    private $themeService;
    private $contactFormService;

    public function __construct(
        SeoService $seoService,
        GeneralService $generalService,
        ThemeService $themeService,
        ContactFormService $contactFormService,
    )
    {
        $this->seoService = $seoService;
        $this->generalService = $generalService;
        $this->themeService = $themeService;
        $this->contactFormService = $contactFormService;
    }

    public function get(){
        $seo = $this->seoService->getBySlugMain('contact-page');
        $generalSetting = $this->generalService->getById(1);
        $themeSetting = $this->themeService->getById(1);
        return view('main.pages.contact', compact(['seo', 'generalSetting', 'themeSetting']));
    }

    public function post(ContactFormRequest $request){

        try {
            //code...
            $this->contactFormService->create(
                $request->validated()
            );
            return response()->json(["message" => "Enquiry recieved successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }

}
