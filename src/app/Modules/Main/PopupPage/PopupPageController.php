<?php

namespace App\Modules\Main\PopupPage;

use App\Http\Controllers\Controller;
use App\Http\Services\DecryptService;
use App\Http\Services\OtpService;
use App\Http\Services\RateLimitService;
use App\Http\Services\SelldoService;
use App\Modules\Enquiry\PopupForm\Requests\PopupFormRequest;
use App\Modules\Enquiry\ContactForm\Requests\OtpFormRequest;
use App\Modules\Enquiry\ContactForm\Requests\ResendOtpFormRequest;
use App\Modules\Enquiry\PopupForm\Services\PopupFormService;
use App\Modules\Project\Projects\Services\ProjectService;

class PopupPageController extends Controller
{
    private $contactFormService;
    private $projectService;

    public function __construct(
        PopupFormService $contactFormService,
        ProjectService $projectService,
    )
    {
        $this->contactFormService = $contactFormService;
        $this->projectService = $projectService;
    }

    public function post(PopupFormRequest $request){

        $project = $this->projectService->getById($request->project_id);
        try {
            //code...
            $data = $this->contactFormService->create(
                [
                    ...$request->validated(),
                    'otp' => rand(1000,9999),
                    'ip_address' => $request->ip(),
                    'is_verified' => false,
                    'project' => $project->name,
                ]
            );
            (new RateLimitService($request))->clearRateLimit();
            (new OtpService)->sendOtp($data->phone, $data->otp);
            $uuid = (new DecryptService)->encryptId($data->id);
            return response()->json(["uuid" => $uuid, "link" => route('popup_page.verifyOtp', $uuid)], 201);
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

                // (new SelldoService)->popup_form_create($data->name, $data->email, $data->phone, $data->project_detail->srd_code, $data->project_detail->projectId);
                return response()->json(["message" => "Enquiry recieved successfully."], 201);
            }
            return response()->json(["message" => "Invalid OTP. Please try again"], 400);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }

}
