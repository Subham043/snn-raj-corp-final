<?php

namespace App\Modules\Project\Amenitys\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\Amenitys\Requests\AmenityUpdateRequest;
use App\Modules\Project\Amenitys\Services\AmenityService;
use App\Modules\Project\Projects\Services\ProjectService;

class AmenityUpdateController extends Controller
{
    private $amenityService;
    private $projectService;

    public function __construct(AmenityService $amenityService, ProjectService $projectService)
    {
        $this->middleware('permission:list projects', ['only' => ['get','post']]);
        $this->amenityService = $amenityService;
        $this->projectService = $projectService;
    }

    public function get($project_id, $id){
        $this->projectService->getById($project_id);
        $data = $this->amenityService->getByIdAndProjectId($id, $project_id);
        return view('admin.pages.project.amenity.update', compact('data', 'project_id'));
    }

    public function post(AmenityUpdateRequest $request, $project_id, $id){
        $this->projectService->getById($project_id);
        $amenity = $this->amenityService->getByIdAndProjectId($id, $project_id);
        try {
            //code...
            $this->amenityService->update(
                $request->except('image'),
                $amenity
            );
            if($request->hasFile('image')){
                $this->amenityService->saveImage($amenity);
            }
            return response()->json(["message" => "Amenity updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
