<?php

namespace App\Modules\Project\Plans\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\Plans\Requests\PlanCreateRequest;
use App\Modules\Project\Plans\Services\PlanService;
use App\Modules\Project\Projects\Services\ProjectService;

class PlanCreateController extends Controller
{
    private $planService;
    private $projectService;

    public function __construct(PlanService $planService, ProjectService $projectService)
    {
        $this->middleware('permission:list projects', ['only' => ['get','post']]);
        $this->planService = $planService;
        $this->projectService = $projectService;
    }

    public function get($project_id){
        $this->projectService->getById($project_id);
        return view('admin.pages.project.plan.create', compact(['project_id']));
    }

    public function post(PlanCreateRequest $request, $project_id){

        $this->projectService->getById($project_id);
        try {
            //code...
            $plan = $this->planService->create(
                $request->except('image'),
                $project_id
            );
            if($request->hasFile('image')){
                $this->planService->saveImage($plan);
            }
            return response()->json(["message" => "Plan created successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
