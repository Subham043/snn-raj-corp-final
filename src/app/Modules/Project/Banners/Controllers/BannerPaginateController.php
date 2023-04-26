<?php

namespace App\Modules\Project\Banners\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\Banners\Services\BannerService;
use App\Modules\Project\Projects\Services\ProjectService;
use Illuminate\Http\Request;

class BannerPaginateController extends Controller
{
    private $bannerService;
    private $projectService;

    public function __construct(BannerService $bannerService, ProjectService $projectService)
    {
        $this->middleware('permission:list projects', ['only' => ['get']]);
        $this->bannerService = $bannerService;
        $this->projectService = $projectService;
    }

    public function get(Request $request, $project_id){
        $this->projectService->getById($project_id);
        $data = $this->bannerService->paginate($request->total ?? 10, $project_id);
        return view('admin.pages.project.banner.paginate', compact(['data', 'project_id']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
