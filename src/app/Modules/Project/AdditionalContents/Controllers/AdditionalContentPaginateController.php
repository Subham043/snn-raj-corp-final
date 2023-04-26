<?php

namespace App\Modules\Project\AdditionalContents\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\AdditionalContents\Services\AdditionalContentService;
use App\Modules\Project\Projects\Services\ProjectService;
use Illuminate\Http\Request;

class AdditionalContentPaginateController extends Controller
{
    private $additionalContentService;
    private $projectService;

    public function __construct(AdditionalContentService $additionalContentService, ProjectService $projectService)
    {
        $this->middleware('permission:list projects', ['only' => ['get']]);
        $this->additionalContentService = $additionalContentService;
        $this->projectService = $projectService;
    }

    public function get(Request $request, $project_id){
        $this->projectService->getById($project_id);
        $data = $this->additionalContentService->paginate($request->total ?? 10, $project_id);
        return view('admin.pages.project.additional_content.paginate', compact(['data', 'project_id']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
