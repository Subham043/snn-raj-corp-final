<?php

namespace App\Modules\Main\CareerPage;

use App\Http\Controllers\Controller;
use App\Http\Services\RateLimitService;
use App\Http\Services\SelldoService;
use App\Modules\Enquiry\CareerForm\Jobs\SendCareerFormMailJob;
use App\Modules\Enquiry\CareerForm\Requests\CareerFormRequest;
use App\Modules\Enquiry\CareerForm\Services\CareerFormService;
use App\Modules\Legal\Services\LegalService;
use App\Modules\Seo\Services\SeoService;
use App\Modules\Settings\Services\ChatbotService;
use App\Modules\Settings\Services\GeneralService;
use App\Modules\Settings\Services\ThemeService;

class CareerPageController extends Controller
{
    private $seoService;
    private $generalService;
    private $themeService;
    private $chatbotService;
    private $careerFormService;
    private $legalService;

    public function __construct(
        SeoService $seoService,
        GeneralService $generalService,
        ThemeService $themeService,
        ChatbotService $chatbotService,
        CareerFormService $careerFormService,
        LegalService $legalService,
    )
    {
        $this->seoService = $seoService;
        $this->generalService = $generalService;
        $this->themeService = $themeService;
        $this->chatbotService = $chatbotService;
        $this->careerFormService = $careerFormService;
        $this->legalService = $legalService;
    }

    public function get(){
        $seo = $this->seoService->getBySlugMain('career-page');
        $generalSetting = $this->generalService->getById(1);
        $themeSetting = $this->themeService->getById(1);
        $legal = $this->legalService->main_all();
        return view('main.pages.career', compact(['seo', 'generalSetting', 'themeSetting', 'legal']));
    }

    public function post(CareerFormRequest $request){

        try {
            //code...
            $career = $this->careerFormService->create(
                [
                    ...$request->safe()->except('cv'),
                    'ip_address' => $request->ip(),
                ]
            );
            if($request->hasFile('cv')){
                $data=$this->careerFormService->saveCv($career);
                dispatch(new SendCareerFormMailJob($data));
            }
            (new RateLimitService($request))->clearRateLimit();
            return response()->json(["message" => "Career Enquiry recieved successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }

}
