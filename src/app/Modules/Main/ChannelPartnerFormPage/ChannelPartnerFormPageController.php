<?php

namespace App\Modules\Main\ChannelPartnerFormPage;

use App\Http\Controllers\Controller;
use App\Http\Services\OtpService;
use App\Http\Services\ParamantraService;
use App\Http\Services\RateLimitService;
use App\Modules\Enquiry\ChannelPartnerForm\Requests\ChannelPartnerFormLoginRequest;
use App\Modules\Enquiry\ChannelPartnerForm\Requests\ChannelPartnerFormOtpRequest;
use App\Modules\Enquiry\ChannelPartnerForm\Requests\ChannelPartnerFormRequest;
use App\Modules\Enquiry\ChannelPartnerForm\Services\ChannelPartnerFormService;
use App\Modules\Enquiry\EmpanelmentForm\Services\EmpanelmentFormService;
use App\Modules\Project\Projects\Services\ProjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Modules\Enquiry\ChannelPartnerForm\Exports\ChannelPartnerForm2Export;
use Maatwebsite\Excel\Facades\Excel;

class ChannelPartnerFormPageController extends Controller
{
    private $freeAdFormService;
    private $projectService;

    public function __construct(
        ChannelPartnerFormService $freeAdFormService,
        ProjectService $projectService,
    )
    {
        $this->freeAdFormService = $freeAdFormService;
        $this->projectService = $projectService;
    }

    public function get(){
        $projects = $this->projectService->main_all();
        return view('main.pages.channel_partner_form', compact('projects'));
    }

    public function post(ChannelPartnerFormRequest $request){
        $project = $this->projectService->getById($request->project);
        try {
            //code...
            $this->freeAdFormService->create(
                [
                    ...$request->except('project'),
                    'ip_address' => $request->ip(),
                    'project' => $project->name
                ]
            );
            (new RateLimitService($request))->clearRateLimit();
            $response = (new ParamantraService)->channel_partner_form_create($request->name, $request->email, $request->phone, $project->name, $request->notes, $request->channel_partner_phone);
            return response()->json(["message" => $response], 201);
        } catch (\Throwable $th) {
            throw $th;
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }
    }

    public function login(){
        return view('main.pages.channel_partner.login');
    }

    public function loginPost(ChannelPartnerFormLoginRequest $request){
        try {
            //code...
            $data = (new EmpanelmentFormService)->getByPhone($request->channel_partner_phone);
            $data->otp = rand(1000,9999);
            $data->save();
            (new RateLimitService($request))->clearRateLimit();
            (new OtpService)->sendOtp($data->phone, $data->otp);
            return response()->json(["message" => "Verify your OTP"], 201);
        } catch (\Throwable $th) {
            throw $th;
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }
    }

    public function resendOtp(ChannelPartnerFormLoginRequest $request){
        try {
            //code...
            $data = (new EmpanelmentFormService)->getByPhone($request->channel_partner_phone);
            $data->otp = rand(1000,9999);
            $data->save();
            (new RateLimitService($request))->clearRateLimit();
            (new OtpService)->sendOtp($data->phone, $data->otp);
            return response()->json(["message" => "Otp sent successfully."], 200);
        } catch (\Throwable $th) {
            throw $th;
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }
    }

    public function verifyOtp(ChannelPartnerFormOtpRequest $request){
        try {
            //code...
            $data = (new EmpanelmentFormService)->getByPhone($request->channel_partner_phone);
            if($request->otp===$data->otp){
                $data->otp = rand(1000,9999);
                $data->save();
                Auth::guard('channel_partner')->loginUsingId($data->id);
                (new RateLimitService($request))->clearRateLimit();
                return response()->json(["message" => "Logged in successfully."], 200);
            }
            return response()->json(["message" => "Invalid OTP. Please try again"], 400);
        } catch (\Throwable $th) {
            throw $th;
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }
    }

    public function data(Request $request){
        $data = $this->freeAdFormService->paginatePartner($request->total ?? 10, auth()->user()->phone);
        return view('main.pages.channel_partner.data', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

    public function excel(){
        return Excel::download(new ChannelPartnerForm2Export, 'channel_partner_form.xlsx');
    }

    public function logout(){
        Auth::guard('channel_partner')->logout();
        return redirect()->route('channel_partner_form.login');
    }

}