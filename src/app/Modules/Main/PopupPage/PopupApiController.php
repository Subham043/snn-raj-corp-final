<?php

namespace App\Modules\Main\PopupPage;

use App\Http\Controllers\Controller;
use App\Http\Services\DecryptService;
use App\Http\Services\OtpService;
use App\Http\Services\ParamantraService;
use App\Http\Services\RateLimitService;
use App\Http\Services\SelldoService;
use App\Modules\Enquiry\PopupForm\Services\PopupFormService;
use App\Modules\Project\Projects\Services\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PopupApiController extends Controller
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

    public function post(Request $request){

        $rules = array(
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'country_code' => 'required|string|max:255',
            'phone' => 'required|numeric|digits:10',
            'project_id' => 'required|numeric|exists:projects,id',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:500',
            'page_url' => 'required|url|max:500',
        );

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json(["form_error"=>$validator->errors()], 400);
        }

        $project = $this->projectService->getById($request->project_id);
        try {
            //code...
            $data = $this->contactFormService->create(
                [
                    ...$request->all(),
                    'otp' => rand(1000,9999),
                    'ip_address' => $request->ip(),
                    'is_verified' => false,
                    'project' => $project->name,
                ]
            );
            (new OtpService)->sendOtp($data->phone, $data->otp);
            $uuid = (new DecryptService)->encryptId($data->id);
            return response()->json(["uuid" => $uuid, "link" => route('popup_api.verifyOtp', $uuid)], 201);
        } catch (\Throwable $th) {
            throw $th;
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }

    public function resendOtp(Request $request){
        $rules = array(
            'uuid' => 'required|string',
        );

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json(["form_error"=>$validator->errors()], 400);
        }
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
            return response()->json(["message" => "Otp sent successfully."], 201);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(["message" => "Invalid uuid"], 400);
        }
    }

    public function verifyOtp(Request $request, $uuid){
        $rules = array(
            'otp' => 'required|numeric|digits:4',
            'slug' => 'nullable',
        );

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json(["form_error"=>$validator->errors()], 400);
        }
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
                // (new ParamantraService)->popup_form_create($data->name, $data->email, $data->phone, $data->project);
                return response()->json(["message" => "Enquiry recieved successfully."], 201);
            }
            return response()->json(["message" => "Invalid OTP. Please try again"], 400);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }

}
