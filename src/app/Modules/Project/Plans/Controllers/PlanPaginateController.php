<?php

namespace App\Modules\Project\Plans\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\Plans\Services\PlanService;
use App\Modules\Project\Projects\Services\ProjectService;
use Illuminate\Http\Request;

class PlanPaginateController extends Controller
{
    private $planService;
    private $projectService;

    public function __construct(PlanService $planService, ProjectService $projectService)
    {
        $this->middleware('permission:list projects', ['only' => ['get']]);
        $this->planService = $planService;
        $this->projectService = $projectService;
    }

    public function get(Request $request, $project_id, $plan_category_id){
        $this->projectService->getById($project_id);
        $data = $this->planService->paginate($request->total ?? 10, $plan_category_id);
        return view('admin.pages.project.plan.paginate', compact(['data', 'project_id', 'plan_category_id']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
