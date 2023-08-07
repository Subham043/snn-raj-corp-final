<?php

namespace App\Modules\Main\ReferalPage;

use App\Http\Controllers\Controller;
use App\Http\Services\RateLimitService;
use App\Http\Services\SelldoService;
use App\Modules\Enquiry\ReferalForm\Jobs\SendReferalFormMailJob;
use App\Modules\Enquiry\ReferalForm\Requests\ReferalFormRequest;
use App\Modules\Enquiry\ReferalForm\Services\ReferalFormService;
use App\Modules\Legal\Services\LegalService;
use App\Modules\Project\Projects\Services\ProjectService;
use App\Modules\Referal\Banners\Services\BannerService;
use App\Modules\Seo\Services\SeoService;
use App\Modules\Settings\Services\ChatbotService;
use App\Modules\Settings\Services\GeneralService;
use App\Modules\Settings\Services\ThemeService;

class ReferalPageController extends Controller
{
    private $seoService;
    private $generalService;
    private $themeService;
    private $chatbotService;
    private $referalFormService;
    private $legalService;
    private $bannerService;
    private $projectService;

    public function __construct(
        SeoService $seoService,
        GeneralService $generalService,
        ThemeService $themeService,
        ChatbotService $chatbotService,
        ReferalFormService $referalFormService,
        LegalService $legalService,
        BannerService $bannerService,
        ProjectService $projectService,
    )
    {
        $this->seoService = $seoService;
        $this->generalService = $generalService;
        $this->themeService = $themeService;
        $this->chatbotService = $chatbotService;
        $this->referalFormService = $referalFormService;
        $this->legalService = $legalService;
        $this->bannerService = $bannerService;
        $this->projectService = $projectService;
    }

    public function get(){
        $seo = $this->seoService->getBySlugMain('referal-page');
        $generalSetting = $this->generalService->getById(1);
        $themeSetting = $this->themeService->getById(1);
        $chatbotSetting = $this->chatbotService->getById(1);
        $legal = $this->legalService->main_all();
        $banner = $this->bannerService->main_all();
        $projects = $this->projectService->main_all();
        return view('main.pages.referal', compact(['seo', 'generalSetting', 'themeSetting', 'chatbotSetting', 'legal', 'banner', 'projects']));
    }

    public function post(ReferalFormRequest $request){

        try {
            //code...
            $data = $this->referalFormService->create(
                $request->validated()
            );
            (new RateLimitService($request))->clearRateLimit();
            (new SelldoService)->contact_create($request->referal_name, $request->referal_email, $request->referal_phone);
            dispatch(new SendReferalFormMailJob($data));
            return response()->json(["message" => "Enquiry recieved successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }

}
