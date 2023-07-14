<?php

namespace App\Modules\Main\ChannelPartnerPage;

use App\Http\Controllers\Controller;
use App\Http\Services\RateLimitService;
use App\Modules\Enquiry\EmpanelmentForm\Jobs\SendEmpanelmentFormMailJob;
use App\Modules\Enquiry\EmpanelmentForm\Requests\EmpanelmentFormRequest;
use App\Modules\Legal\Services\LegalService;
use App\Modules\Seo\Services\SeoService;
use App\Modules\Settings\Services\ChatbotService;
use App\Modules\Settings\Services\GeneralService;
use App\Modules\Settings\Services\ThemeService;
use App\Modules\Enquiry\EmpanelmentForm\Services\EmpanelmentFormService;

class ChannelPartnerPageController extends Controller
{
    private $seoService;
    private $generalService;
    private $themeService;
    private $chatbotService;
    private $legalService;
    private $empanelmentFormService;

    public function __construct(
        SeoService $seoService,
        GeneralService $generalService,
        ThemeService $themeService,
        ChatbotService $chatbotService,
        LegalService $legalService,
        EmpanelmentFormService $empanelmentFormService,
    )
    {
        $this->seoService = $seoService;
        $this->generalService = $generalService;
        $this->themeService = $themeService;
        $this->chatbotService = $chatbotService;
        $this->legalService = $legalService;
        $this->empanelmentFormService = $empanelmentFormService;
    }

    public function get(){
        $seo = $this->seoService->getBySlugMain('channel-partner-page');
        $generalSetting = $this->generalService->getById(1);
        $themeSetting = $this->themeService->getById(1);
        $chatbotSetting = $this->chatbotService->getById(1);
        $legal = $this->legalService->main_all();
        return view('main.pages.channel_partner', compact(['seo', 'generalSetting', 'themeSetting', 'chatbotSetting', 'legal']));
    }

    public function post(EmpanelmentFormRequest $request){

        try {
            //code...
            $empanelment = $this->empanelmentFormService->create(
                [
                    ...$request->safe()->except(['msme_image', 'pan_image', 'gst_image', 'seal_image', 'cheque_image', 'rera_image']),
                    'ip_address' => $request->ip(),
                ]
            );
            if($request->hasFile('msme_image')){
                $data = $this->empanelmentFormService->saveFile($empanelment, 'msme_image');
            }
            if($request->hasFile('pan_image')){
                $data = $this->empanelmentFormService->saveFile($empanelment, 'pan_image');
            }
            if($request->hasFile('gst_image')){
                $data = $this->empanelmentFormService->saveFile($empanelment, 'gst_image');
            }
            if($request->hasFile('seal_image')){
                $data = $this->empanelmentFormService->saveFile($empanelment, 'seal_image');
            }
            if($request->hasFile('cheque_image')){
                $data = $this->empanelmentFormService->saveFile($empanelment, 'cheque_image');
            }
            if($request->hasFile('rera_image')){
                $data = $this->empanelmentFormService->saveFile($empanelment, 'rera_image');
            }
            (new RateLimitService($request))->clearRateLimit();
            dispatch(new SendEmpanelmentFormMailJob($data));
            return response()->json(["message" => "Empanelment Enquiry recieved successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }

}
