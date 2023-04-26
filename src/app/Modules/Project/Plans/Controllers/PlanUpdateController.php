<?php

namespace App\Modules\Project\Plans\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\Plans\Requests\PlanUpdateRequest;
use App\Modules\Project\Plans\Services\PlanService;
use App\Modules\Project\Projects\Services\ProjectService;

class PlanUpdateController extends Controller
{
    private $planService;
    private $projectService;

    public function __construct(PlanService $planService, ProjectService $projectService)
    {
        $this->middleware('permission:list projects', ['only' => ['get','post']]);
        $this->planService = $planService;
        $this->projectService = $projectService;
    }

    public function get($project_id, $id){
        $this->projectService->getById($project_id);
        $data = $this->planService->getByIdAndProjectId($id, $project_id);
        return view('admin.pages.project.plan.update', compact('data', 'project_id'));
    }

    public function post(PlanUpdateRequest $request, $project_id, $id){
        $this->projectService->getById($project_id);
        $plan = $this->planService->getByIdAndProjectId($id, $project_id);
        try {
            //code...
            $this->planService->update(
                $request->except('image'),
                $plan
            );
            if($request->hasFile('image')){
                $this->planService->saveImage($plan);
            }
            return response()->json(["message" => "Plan updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
