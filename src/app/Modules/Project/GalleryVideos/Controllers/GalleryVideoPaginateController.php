<?php

namespace App\Modules\Project\GalleryVideos\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\GalleryVideos\Services\GalleryVideoService;
use App\Modules\Project\Projects\Services\ProjectService;
use Illuminate\Http\Request;

class GalleryVideoPaginateController extends Controller
{
    private $galleryVideoService;
    private $projectService;

    public function __construct(GalleryVideoService $galleryVideoService, ProjectService $projectService)
    {
        $this->middleware('permission:list projects', ['only' => ['get']]);
        $this->galleryVideoService = $galleryVideoService;
        $this->projectService = $projectService;
    }

    public function get(Request $request, $project_id){
        $this->projectService->getById($project_id);
        $data = $this->galleryVideoService->paginate($request->total ?? 10, $project_id);
        return view('admin.pages.project.gallery_video.paginate', compact(['data', 'project_id']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
