<?php

namespace App\Modules\Campaigns\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Services\DecryptService;
use App\Http\Services\OtpService;
use App\Http\Services\ParamantraService;
use App\Http\Services\RateLimitService;
use App\Http\Services\SelldoService;
use App\Modules\Campaigns\Services\CampaignService;
use App\Modules\Enquiry\ContactForm\Requests\OtpFormRequest;
use App\Modules\Enquiry\ContactForm\Requests\ResendOtpFormRequest;
use App\Modules\Enquiry\ProjectCampaignForm\Requests\ProjectCampaignFormRequest;
use App\Modules\Enquiry\ProjectCampaignForm\Services\ProjectCampaignFormService;
use App\Modules\Project\Projects\Models\Project;

class CampaignEnquiryMainController extends Controller
{
    private $campaignFormService;
    private $campaignService;

    public function __construct(ProjectCampaignFormService $campaignFormService, CampaignService $campaignService)
    {
        $this->campaignFormService = $campaignFormService;
        $this->campaignService = $campaignService;
    }

    public function post(ProjectCampaignFormRequest $request){

        try {
            //code...
            $data = $this->campaignFormService->create(
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
            return response()->json(["uuid" => $uuid, "link" => route('enquiry.verifyOtp', $uuid)], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }

    public function resendOtp(ResendOtpFormRequest $request){
        try {
            //code...
            $id = (new DecryptService)->decryptId($request->uuid);
            $data = $this->campaignFormService->getById($id);
            $new_data = $this->campaignFormService->update(
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
            $data = $this->campaignFormService->getById($id);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(["message" => "Invalid uuid"], 400);
        }

        try {
            //code...
            if($request->otp===$data->otp){
                (new RateLimitService($request))->clearRateLimit();
                $this->campaignFormService->update(
                    [
                        'otp' => rand(1000,9999),
                        'is_verified' => true,
                    ],
                    $data
                );
                $campaign = $this->campaignService->getById($request->slug);
                // (new SelldoService)->project_campaign_create($data->name, $data->email, $data->phone, $campaign->srd, $campaign->projectId);
                (new ParamantraService)->project_campaign_create($data->name, $data->email, $data->phone, $campaign->name);
                return response()->json(["message" => "Enquiry recieved successfully."], 201);
            }
            return response()->json(["message" => "Invalid OTP. Please try again"], 400);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
