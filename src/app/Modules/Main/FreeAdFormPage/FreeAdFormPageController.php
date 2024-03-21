<?php

namespace App\Modules\Main\FreeAdFormPage;

use App\Http\Controllers\Controller;
use App\Http\Services\ParamantraService;
use App\Http\Services\RateLimitService;
use App\Modules\Enquiry\FreeAdForm\Requests\FreeAdFormRequest;
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

    public function post(FreeAdFormRequest $request){
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
            $response = (new ParamantraService)->campaign_form_create($request->name, $request->email, $request->phone, $request->source, $project->name, $request->executive_name);
            return response()->json(["message" => $response], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }

}