<?php

namespace App\Modules\Main\FreeAdFormPage;

use App\Http\Controllers\Controller;
use App\Http\Services\RateLimitService;
use App\Http\Services\SelldoService;
use App\Modules\Enquiry\FreeAdForm\Requests\FreeAdFormRequest;
use App\Modules\Enquiry\FreeAdForm\Requests\FreeAdFormVerifyRequest;
use App\Modules\Enquiry\FreeAdForm\Services\FreeAdFormService;
use App\Modules\Project\Projects\Services\ProjectService;

class FreeAdFormPageController extends Controller
{
    private $freeAdFormService;
    private $projectService;

    public function __construct(
        FreeAdFormService $freeAdFormService,
        ProjectService $projectService,
    )
    {
        $this->freeAdFormService = $freeAdFormService;
        $this->projectService = $projectService;
    }

    public function get(){
        $projects = $this->projectService->main_all();
        return view('main.pages.free_ad_form', compact('projects'));
    }

    public function verify(FreeAdFormVerifyRequest $request){

        $status = (new SelldoService)->verify($request->phone);
        if($status){
            (new RateLimitService($request))->clearRateLimit();
            return response()->json(["message" => "Verified successfully.", "status" => $status], 200);
        }
        return response()->json(["message" => "Not verified.", "status" => $status], 400);

    }

    public function post(FreeAdFormRequest $request){

        try {
            //code...
            $this->freeAdFormService->create(
                [
                    ...$request->validated(),
                    'ip_address' => $request->ip(),
                ]
            );
            (new RateLimitService($request))->clearRateLimit();
            (new SelldoService)->campaign_create($request->name, $request->email, $request->phone, $request->source, $request->project, $request->executive_name);
            return response()->json(["message" => "Campaign Enquiry recieved successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }

}
