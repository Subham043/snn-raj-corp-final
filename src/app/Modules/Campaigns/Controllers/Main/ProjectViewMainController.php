<?php

namespace App\Modules\Projects\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Modules\Projects\Services\ProjectService;

class ProjectViewMainController extends Controller
{
    private $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function get($slug){
        $data = $this->projectService->getBySlug($slug);
        return view('project.pages.index')->with('data', $data);
    }

    public function thank($slug){
        $data = $this->projectService->getBySlug($slug);
        return view('project.pages.thank')->with('data', $data);
    }
}
