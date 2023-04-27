<?php

namespace App\Modules\Project\AdditionalContents\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\AdditionalContents\Services\AdditionalContentService;
use App\Modules\Project\Projects\Services\ProjectService;

class AdditionalContentDeleteController extends Controller
{
    private $additionalContentService;
    private $projectService;

    public function __construct(AdditionalContentService $additionalContentService, ProjectService $projectService)
    {
        $this->middleware('permission:list projects', ['only' => ['get']]);
        $this->additionalContentService = $additionalContentService;
        $this->projectService = $projectService;
    }

    public function get($project_id, $id){
        $project = $this->projectService->getById($project_id);
        $additionalContent = $this->additionalContentService->getByIdAndProjectId($id, $project_id);

        try {
            //code...
            $this->additionalContentService->delete(
                $additionalContent
            );
            $this->projectService->clear_cache($project);
            return redirect()->back()->with('success_status', 'Additional Content deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
