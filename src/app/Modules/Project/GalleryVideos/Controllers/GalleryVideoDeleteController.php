<?php

namespace App\Modules\Project\GalleryVideos\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\GalleryVideos\Services\GalleryVideoService;
use App\Modules\Project\Projects\Services\ProjectService;

class GalleryVideoDeleteController extends Controller
{
    private $galleryVideoService;
    private $projectService;

    public function __construct(GalleryVideoService $galleryVideoService, ProjectService $projectService)
    {
        $this->middleware('permission:list projects', ['only' => ['get']]);
        $this->galleryVideoService = $galleryVideoService;
        $this->projectService = $projectService;
    }

    public function get($project_id, $id){
        $this->projectService->getById($project_id);
        $video = $this->galleryVideoService->getByIdAndProjectId($id, $project_id);

        try {
            //code...
            $this->galleryVideoService->delete(
                $video
            );
            return redirect()->back()->with('success_status', 'Gallery Video deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
