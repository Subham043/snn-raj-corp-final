<?php

namespace App\Modules\Project\Banners\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\Banners\Services\BannerService;
use App\Modules\Project\Projects\Services\ProjectService;

class BannerDeleteController extends Controller
{
    private $bannerService;
    private $projectService;

    public function __construct(BannerService $bannerService, ProjectService $projectService)
    {
        $this->middleware('permission:list projects', ['only' => ['get']]);
        $this->bannerService = $bannerService;
        $this->projectService = $projectService;
    }

    public function get($project_id, $id){
        $project = $this->projectService->getById($project_id);
        $banner = $this->bannerService->getByIdAndProjectId($id, $project_id);

        try {
            //code...
            $this->bannerService->delete(
                $banner
            );
            return redirect()->back()->with('success_status', 'Banner deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
