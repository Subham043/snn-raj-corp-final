<?php

namespace App\Modules\Project\GalleryVideos\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\GalleryVideos\Requests\GalleryVideoRequest;
use App\Modules\Project\GalleryVideos\Services\GalleryVideoService;
use App\Modules\Project\Projects\Services\ProjectService;

class GalleryVideoCreateController extends Controller
{
    private $galleryVideoService;
    private $projectService;

    public function __construct(GalleryVideoService $galleryVideoService, ProjectService $projectService)
    {
        $this->middleware('permission:list projects', ['only' => ['get','post']]);
        $this->galleryVideoService = $galleryVideoService;
        $this->projectService = $projectService;
    }

    public function get($project_id){
        $this->projectService->getById($project_id);
        return view('admin.pages.project.gallery_video.create', compact(['project_id']));
    }

    public function post(GalleryVideoRequest $request, $project_id){

        $project = $this->projectService->getById($project_id);
        try {
            //code...
            $this->galleryVideoService->create(
                $request->validated(),
                $project_id
            );
            return response()->json(["message" => "Gallery Video created successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
