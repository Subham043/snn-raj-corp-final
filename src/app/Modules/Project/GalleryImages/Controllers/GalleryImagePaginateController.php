<?php

namespace App\Modules\Project\GalleryImages\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\GalleryImages\Services\GalleryImageService;
use App\Modules\Project\Projects\Services\ProjectService;
use Illuminate\Http\Request;

class GalleryImagePaginateController extends Controller
{
    private $galleryImageService;
    private $projectService;

    public function __construct(GalleryImageService $galleryImageService, ProjectService $projectService)
    {
        $this->middleware('permission:list projects', ['only' => ['get']]);
        $this->galleryImageService = $galleryImageService;
        $this->projectService = $projectService;
    }

    public function get(Request $request, $project_id){
        $this->projectService->getById($project_id);
        $data = $this->galleryImageService->paginate($request->total ?? 10, $project_id);
        return view('admin.pages.project.gallery_image.paginate', compact(['data', 'project_id']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
