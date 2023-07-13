<?php

namespace App\Modules\Project\PlanCategory\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\PlanCategory\Requests\PlanCategoryCreateRequest;
use App\Modules\Project\PlanCategory\Services\PlanCategoryService;
use App\Modules\Project\Projects\Services\ProjectService;

class PlanCategoryCreateController extends Controller
{
    private $planService;
    private $projectService;

    public function __construct(PlanCategoryService $planService, ProjectService $projectService)
    {
        $this->middleware('permission:list projects', ['only' => ['get','post']]);
        $this->planService = $planService;
        $this->projectService = $projectService;
    }

    public function get($project_id){
        $this->projectService->getById($project_id);
        return view('admin.pages.project.plan_category.create', compact(['project_id']));
    }

    public function post(PlanCategoryCreateRequest $request, $project_id){

        $project = $this->projectService->getById($project_id);
        try {
            //code...
            $plan = $this->planService->create(
                $request->except('image'),
                $project_id
            );
            $this->projectService->clear_cache($project);
            return response()->json(["message" => "Plan Category created successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
