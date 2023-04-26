<?php

namespace App\Modules\Project\Amenitys\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\Amenitys\Services\AmenityService;
use App\Modules\Project\Projects\Services\ProjectService;
use Illuminate\Http\Request;

class AmenityPaginateController extends Controller
{
    private $amenityService;
    private $projectService;

    public function __construct(AmenityService $amenityService, ProjectService $projectService)
    {
        $this->middleware('permission:list projects', ['only' => ['get']]);
        $this->amenityService = $amenityService;
        $this->projectService = $projectService;
    }

    public function get(Request $request, $project_id){
        $this->projectService->getById($project_id);
        $data = $this->amenityService->paginate($request->total ?? 10, $project_id);
        return view('admin.pages.project.amenity.paginate', compact(['data', 'project_id']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
