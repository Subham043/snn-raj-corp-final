<?php

namespace App\Modules\Project\PlanCategory\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\PlanCategory\Services\PlanCategoryService;
use App\Modules\Project\Projects\Services\ProjectService;
use Illuminate\Http\Request;

class PlanCategoryPaginateController extends Controller
{
    private $planService;
    private $projectService;

    public function __construct(PlanCategoryService $planService, ProjectService $projectService)
    {
        $this->middleware('permission:list projects', ['only' => ['get']]);
        $this->planService = $planService;
        $this->projectService = $projectService;
    }

    public function get(Request $request, $project_id){
        $this->projectService->getById($project_id);
        $data = $this->planService->paginate($request->total ?? 10, $project_id);
        return view('admin.pages.project.plan_category.paginate', compact(['data', 'project_id']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
