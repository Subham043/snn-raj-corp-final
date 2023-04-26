<?php

namespace App\Modules\Project\Amenitys\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\Amenitys\Requests\AmenityCreateRequest;
use App\Modules\Project\Amenitys\Services\AmenityService;
use App\Modules\Project\Projects\Services\ProjectService;

class AmenityCreateController extends Controller
{
    private $amenityService;
    private $projectService;

    public function __construct(AmenityService $amenityService, ProjectService $projectService)
    {
        $this->middleware('permission:list projects', ['only' => ['get','post']]);
        $this->amenityService = $amenityService;
        $this->projectService = $projectService;
    }

    public function get($project_id){
        $this->projectService->getById($project_id);
        return view('admin.pages.project.amenity.create', compact(['project_id']));
    }

    public function post(AmenityCreateRequest $request, $project_id){

        $this->projectService->getById($project_id);
        try {
            //code...
            $amenity = $this->amenityService->create(
                $request->except('image'),
                $project_id
            );
            if($request->hasFile('image')){
                $this->amenityService->saveImage($amenity);
            }
            return response()->json(["message" => "Amenity created successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
