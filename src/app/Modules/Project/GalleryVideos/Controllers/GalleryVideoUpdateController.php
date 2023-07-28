<?php

namespace App\Modules\Project\GalleryVideos\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\GalleryVideos\Requests\GalleryVideoRequest;
use App\Modules\Project\GalleryVideos\Services\GalleryVideoService;
use App\Modules\Project\Projects\Services\ProjectService;

class GalleryVideoUpdateController extends Controller
{
    private $galleryVideoService;
    private $projectService;

    public function __construct(GalleryVideoService $galleryVideoService, ProjectService $projectService)
    {
        $this->middleware('permission:list projects', ['only' => ['get','post']]);
        $this->galleryVideoService = $galleryVideoService;
        $this->projectService = $projectService;
    }

    public function get($project_id, $id){
        $this->projectService->getById($project_id);
        $data = $this->galleryVideoService->getByIdAndProjectId($id, $project_id);
        return view('admin.pages.project.gallery_video.update', compact('data', 'project_id'));
    }

    public function post(GalleryVideoRequest $request, $project_id, $id){
        $project = $this->projectService->getById($project_id);
        $gallery_video = $this->galleryVideoService->getByIdAndProjectId($id, $project_id);
        try {
            //code...
            $this->galleryVideoService->update(
                $request->validated(),
                $gallery_video
            );
            return response()->json(["message" => "Gallery Video updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
