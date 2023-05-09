<?php

namespace App\Modules\Project\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\Projects\Services\ProjectHeadingService;
use App\Modules\Project\Projects\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectPaginateController extends Controller
{
    private $projectService;
    private $projectHeadingService;

    public function __construct(ProjectService $projectService, ProjectHeadingService $projectHeadingService)
    {
        $this->middleware('permission:list projects', ['only' => ['get']]);
        $this->projectService = $projectService;
        $this->projectHeadingService = $projectHeadingService;
    }

    public function get(Request $request){
        $projectHeading = $this->projectHeadingService->getById(1);
        $data = $this->projectService->paginate($request->total ?? 10);
        return view('admin.pages.project.paginate', compact(['data', 'projectHeading']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
