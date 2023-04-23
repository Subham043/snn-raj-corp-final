<?php

namespace App\Modules\Project\Accomodations\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\Accomodations\Services\AccomodationHeadingService;
use App\Modules\Project\Accomodations\Services\AccomodationService;
use App\Modules\Project\Projects\Services\ProjectService;
use Illuminate\Http\Request;

class AccomodationPaginateController extends Controller
{
    private $accomodationService;
    private $projectService;

    public function __construct(AccomodationService $accomodationService, ProjectService $projectService)
    {
        $this->middleware('permission:list projects', ['only' => ['get']]);
        $this->accomodationService = $accomodationService;
        $this->projectService = $projectService;
    }

    public function get(Request $request, $project_id){
        $this->projectService->getById($project_id);
        $data = $this->accomodationService->paginate($request->total ?? 10, $project_id);
        return view('admin.pages.project.accomodation.paginate', compact(['data', 'project_id']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
