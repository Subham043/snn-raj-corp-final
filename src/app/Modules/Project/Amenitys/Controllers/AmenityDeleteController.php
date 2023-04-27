<?php

namespace App\Modules\Project\Amenitys\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\Amenitys\Services\AmenityService;
use App\Modules\Project\Projects\Services\ProjectService;

class AmenityDeleteController extends Controller
{
    private $amenityService;
    private $projectService;

    public function __construct(AmenityService $amenityService, ProjectService $projectService)
    {
        $this->middleware('permission:list projects', ['only' => ['get']]);
        $this->amenityService = $amenityService;
        $this->projectService = $projectService;
    }

    public function get($project_id, $id){
        $project = $this->projectService->getById($project_id);
        $amenity = $this->amenityService->getByIdAndProjectId($id, $project_id);

        try {
            //code...
            $this->amenityService->delete(
                $amenity
            );
            $this->projectService->clear_cache($project);
            return redirect()->back()->with('success_status', 'Amenity deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
