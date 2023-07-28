<?php

namespace App\Modules\Project\GalleryImages\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\GalleryImages\Services\GalleryImageService;
use App\Modules\Project\Projects\Services\ProjectService;

class GalleryImageDeleteController extends Controller
{
    private $galleryImageService;
    private $projectService;

    public function __construct(GalleryImageService $galleryImageService, ProjectService $projectService)
    {
        $this->middleware('permission:list projects', ['only' => ['get']]);
        $this->galleryImageService = $galleryImageService;
        $this->projectService = $projectService;
    }

    public function get($project_id, $id){
        $project = $this->projectService->getById($project_id);
        $image = $this->galleryImageService->getByIdAndProjectId($id, $project_id);

        try {
            //code...
            $this->galleryImageService->delete(
                $image
            );
            return redirect()->back()->with('success_status', 'Gallery Image deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
