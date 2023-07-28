<?php

namespace App\Modules\Project\PlanCategory\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\PlanCategory\Services\PlanCategoryService;
use App\Modules\Project\Projects\Services\ProjectService;

class PlanCategoryDeleteController extends Controller
{
    private $planService;
    private $projectService;

    public function __construct(PlanCategoryService $planService, ProjectService $projectService)
    {
        $this->middleware('permission:list projects', ['only' => ['get']]);
        $this->planService = $planService;
        $this->projectService = $projectService;
    }

    public function get($project_id, $id){
        $project = $this->projectService->getById($project_id);
        $plan = $this->planService->getByIdAndProjectId($id, $project_id);

        try {
            //code...
            $this->planService->delete(
                $plan
            );
            return redirect()->back()->with('success_status', 'Plan Category deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
