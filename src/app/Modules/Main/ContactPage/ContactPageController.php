<?php

namespace App\Modules\Main\ContactPage;

use App\Http\Controllers\Controller;
use App\Http\Services\DecryptService;
use App\Http\Services\OtpService;
use App\Http\Services\ParamantraService;
use App\Http\Services\RateLimitService;
use App\Http\Services\SelldoService;
use App\Modules\Enquiry\ContactForm\Requests\ContactFormRequest;
use App\Modules\Enquiry\ContactForm\Requests\OtpFormRequest;
use App\Modules\Enquiry\ContactForm\Requests\ResendOtpFormRequest;
use App\Modules\Enquiry\ContactForm\Services\ContactFormService;
use App\Modules\Enquiry\ContactForm\Jobs\SendContactFormMailJob;
use App\Modules\Legal\Services\LegalService;
use App\Modules\Project\Projects\Models\Project;
use App\Modules\Seo\Services\SeoService;
use App\Modules\Settings\Services\ChatbotService;
use App\Modules\Settings\Services\GeneralService;
use App\Modules\Settings\Services\ThemeService;

class ContactPageController extends Controller
{
    private $seoService;
    private $generalService;
    private $themeService;
    private $chatbotService;
    private $contactFormService;
    private $legalService;

    public function __construct(
        SeoService $seoService,
        GeneralService $generalService,
        ThemeService $themeService,
        ChatbotService $chatbotService,
        ContactFormService $contactFormService,
        LegalService $legalService,
    )
    {
        $this->seoService = $seoService;
        $this->generalService = $generalService;
        $this->themeService = $themeService;
        $this->chatbotService = $chatbotService;
        $this->contactFormService = $contactFormService;
        $this->legalService = $legalService;
    }

    public function get(){
        $seo = $this->seoService->getBySlugMain('contact-page');
        $generalSetting = $this->generalService->getById(1);
        $themeSetting = $this->themeService->getById(1);
        $chatbotSetting = $this->chatbotService->getById(1);
        $legal = $this->legalService->main_all();
        return view('main.pages.contact', compact(['seo', 'generalSetting', 'themeSetting', 'chatbotSetting', 'legal']));
    }

    public function post(ContactFormRequest $request){

        try {
            //code...
            $data = $this->contactFormService->create(
                [
                    ...$request->validated(),
                    'otp' => rand(1000,9999),
                    'ip_address' => $request->ip(),
                    'is_verified' => false,
                ]
            );
            (new RateLimitService($request))->clearRateLimit();
            (new OtpService)->sendOtp($data->phone, $data->otp);
            $uuid = (new DecryptService)->encryptId($data->id);
            return response()->json(["uuid" => $uuid, "link" => route('contact_page.verifyOtp', $uuid)], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }

    public function resendOtp(ResendOtpFormRequest $request){
        try {
            //code...
            $id = (new DecryptService)->decryptId($request->uuid);
            $data = $this->contactFormService->getById($id);
            $new_data = $this->contactFormService->update(
                [
                    'otp' => rand(1000,9999),
                ],
                $data
            );
            (new OtpService)->sendOtp($new_data->phone, $new_data->otp);
            (new RateLimitService($request))->clearRateLimit();
            return response()->json(["message" => "Otp sent successfully."], 201);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(["message" => "Invalid uuid"], 400);
        }
    }

    public function verifyOtp(OtpFormRequest $request, $uuid){

        try {
            //code...
            $id = (new DecryptService)->decryptId($uuid);
            $data = $this->contactFormService->getById($id);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(["message" => "Invalid uuid"], 400);
        }

        try {
            //code...
            if($request->otp===$data->otp){
                (new RateLimitService($request))->clearRateLimit();
                $this->contactFormService->update(
                    [
                        'otp' => rand(1000,9999),
                        'is_verified' => true,
                    ],
                    $data
                );
                // (new SelldoService)->contact_create($data->name, $data->email, $data->phone);
                (new ParamantraService)->contact_create($data->name, $data->email, $data->phone, 'Lead from Contact Us Page');
                dispatch(new SendContactFormMailJob($data));
                return response()->json(["message" => "Enquiry recieved successfully."], 201);
            }
            return response()->json(["message" => "Invalid OTP. Please try again"], 400);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }

}