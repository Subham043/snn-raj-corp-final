<?php

namespace App\Modules\Project\PlanCategory\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\PlanCategory\Requests\PlanCategoryUpdateRequest;
use App\Modules\Project\PlanCategory\Services\PlanCategoryService;
use App\Modules\Project\Projects\Services\ProjectService;

class PlanCategoryUpdateController extends Controller
{
    private $planService;
    private $projectService;

    public function __construct(PlanCategoryService $planService, ProjectService $projectService)
    {
        $this->middleware('permission:list projects', ['only' => ['get','post']]);
        $this->planService = $planService;
        $this->projectService = $projectService;
    }

    public function get($project_id, $id){
        $this->projectService->getById($project_id);
        $data = $this->planService->getByIdAndProjectId($id, $project_id);
        return view('admin.pages.project.plan_category.update', compact('data', 'project_id'));
    }

    public function post(PlanCategoryUpdateRequest $request, $project_id, $id){
        $project = $this->projectService->getById($project_id);
        $plan = $this->planService->getByIdAndProjectId($id, $project_id);
        try {
            //code...
            $this->planService->update(
                $request->except('image'),
                $plan
            );
            $this->projectService->clear_cache($project);
            return response()->json(["message" => "Plan Category updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
