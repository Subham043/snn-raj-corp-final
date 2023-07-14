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
use App\Modules\Project\Projects\Models\Project;

class PopupPageController extends Controller
{
    private $contactFormService;

    public function __construct(
        PopupFormService $contactFormService,
    )
    {
        $this->contactFormService = $contactFormService;
    }

    public function post(PopupFormRequest $request){

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
                switch ($data->project) {
                    case 'Raj High Gardens':
                        # code...
                        $project_id = '63932f2ca6bbc90b878a7f02';
                        $project_srd = '64a7b9070ad1ff10693d9cce';
                        break;

                    case 'Raj Bay Vista':
                        # code...
                        $project_id = '63aa8dddc8256132cbd821dd';
                        $project_srd = '64a7b8a60ad1ff18a2973837';
                        break;

                    case 'Raj Viviente':
                        # code...
                        $project_id = '63a1523ced23e9658b4a2293';
                        $project_srd = '64a7b7240ad1ff10963d9873';
                        break;

                    default:
                        # code...
                        $project_id = '';
                        $project_srd = '64a7ba980ad1ff2cf54646fe';
                        break;
                }
                (new SelldoService)->popup_create($data->name, $data->email, $data->phone, $project_srd, $project_id);
                return response()->json(["message" => "Enquiry recieved successfully."], 201);
            }
            return response()->json(["message" => "Invalid OTP. Please try again"], 400);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }

}
