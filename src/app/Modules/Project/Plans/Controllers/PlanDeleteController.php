<?php

namespace App\Modules\Project\Plans\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\Plans\Services\PlanService;
use App\Modules\Project\Projects\Services\ProjectService;

class PlanDeleteController extends Controller
{
    private $planService;
    private $projectService;

    public function __construct(PlanService $planService, ProjectService $projectService)
    {
        $this->middleware('permission:list projects', ['only' => ['get']]);
        $this->planService = $planService;
        $this->projectService = $projectService;
    }

    public function get($project_id, $plan_category_id, $id){
        $project = $this->projectService->getById($project_id);
        $plan = $this->planService->getByIdAndProjectId($id, $plan_category_id);

        try {
            //code...
            $this->planService->delete(
                $plan
            );
            return redirect()->back()->with('success_status', 'Plan deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
