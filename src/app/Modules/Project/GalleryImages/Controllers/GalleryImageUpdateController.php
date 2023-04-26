<?php

namespace App\Modules\Project\GalleryImages\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\GalleryImages\Requests\GalleryImageUpdateRequest;
use App\Modules\Project\GalleryImages\Services\GalleryImageService;
use App\Modules\Project\Projects\Services\ProjectService;

class GalleryImageUpdateController extends Controller
{
    private $galleryImageService;
    private $projectService;

    public function __construct(GalleryImageService $galleryImageService, ProjectService $projectService)
    {
        $this->middleware('permission:list projects', ['only' => ['get','post']]);
        $this->galleryImageService = $galleryImageService;
        $this->projectService = $projectService;
    }

    public function get($project_id, $id){
        $this->projectService->getById($project_id);
        $data = $this->galleryImageService->getByIdAndProjectId($id, $project_id);
        return view('admin.pages.project.gallery_image.update', compact('data', 'project_id'));
    }

    public function post(GalleryImageUpdateRequest $request, $project_id, $id){
        $this->projectService->getById($project_id);
        $gallery_image = $this->galleryImageService->getByIdAndProjectId($id, $project_id);
        try {
            //code...
            $this->galleryImageService->update(
                $request->except('image'),
                $gallery_image
            );
            if($request->hasFile('image')){
                $this->galleryImageService->saveImage($gallery_image);
            }
            return response()->json(["message" => "Gallery Image updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
