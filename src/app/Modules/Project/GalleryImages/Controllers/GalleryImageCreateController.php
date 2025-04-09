<?php

namespace App\Modules\Project\GalleryImages\Controllers;

use App\Enums\ProjectGalleryStatusEnum;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;
use App\Modules\Project\GalleryImages\Requests\GalleryImageCreateRequest;
use App\Modules\Project\GalleryImages\Services\GalleryImageService;
use App\Modules\Project\Projects\Services\ProjectService;

class GalleryImageCreateController extends Controller
{
    private $galleryImageService;
    private $projectService;

    public function __construct(GalleryImageService $galleryImageService, ProjectService $projectService)
    {
        $this->middleware('permission:list projects', ['only' => ['get','post']]);
        $this->galleryImageService = $galleryImageService;
        $this->projectService = $projectService;
    }

    public function get($project_id){
        $this->projectService->getById($project_id);
        return view('admin.pages.project.gallery_image.create', compact(['project_id']))->with([
            'gallery_statuses' => Arr::map(ProjectGalleryStatusEnum::cases(), fn($enum) => $enum->value),
        ]);
    }

    public function post(GalleryImageCreateRequest $request, $project_id){

        $project = $this->projectService->getById($project_id);
        try {
            //code...
            $gallery_image = $this->galleryImageService->create(
                $request->except('image'),
                $project_id
            );
            if($request->hasFile('image')){
                $this->galleryImageService->saveImage($gallery_image);
            }
            return response()->json(["message" => "Gallery Image created successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
