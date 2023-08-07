<?php

namespace App\Modules\Main\LandOwnerPage;

use App\Http\Controllers\Controller;
use App\Http\Services\RateLimitService;
use App\Http\Services\SelldoService;
use App\Modules\Enquiry\LandOwnerForm\Jobs\SendLandOwnerFormMailJob;
use App\Modules\Enquiry\LandOwnerForm\Requests\LandOwnerFormRequest;
use App\Modules\Enquiry\LandOwnerForm\Services\LandOwnerFormService;
use App\Modules\Legal\Services\LegalService;
use App\Modules\Seo\Services\SeoService;
use App\Modules\Settings\Services\ChatbotService;
use App\Modules\Settings\Services\GeneralService;
use App\Modules\Settings\Services\ThemeService;

class LandOwnerPageController extends Controller
{
    private $seoService;
    private $generalService;
    private $themeService;
    private $chatbotService;
    private $legalService;
    private $landOwnerFormService;

    public function __construct(
        SeoService $seoService,
        GeneralService $generalService,
        ThemeService $themeService,
        ChatbotService $chatbotService,
        LegalService $legalService,
        LandOwnerFormService $landOwnerFormService,
    )
    {
        $this->seoService = $seoService;
        $this->generalService = $generalService;
        $this->themeService = $themeService;
        $this->chatbotService = $chatbotService;
        $this->legalService = $legalService;
        $this->landOwnerFormService = $landOwnerFormService;
    }

    public function get(){
        $seo = $this->seoService->getBySlugMain('land-owner-page');
        $generalSetting = $this->generalService->getById(1);
        $themeSetting = $this->themeService->getById(1);
        $chatbotSetting = $this->chatbotService->getById(1);
        $legal = $this->legalService->main_all();
        return view('main.pages.land_owner', compact(['seo', 'generalSetting', 'themeSetting', 'chatbotSetting', 'legal']));
    }

    public function post(LandOwnerFormRequest $request){

        try {
            //code...
            $data=$this->landOwnerFormService->create(
                [
                    ...$request->validated(),
                    'ip_address' => $request->ip(),
                ]
            );
            (new RateLimitService($request))->clearRateLimit();
            dispatch(new SendLandOwnerFormMailJob($data));
            return response()->json(["message" => "Land Owner Enquiry recieved successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }

}
