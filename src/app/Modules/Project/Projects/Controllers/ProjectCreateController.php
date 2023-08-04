<?php

namespace App\Modules\Project\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\CommonAmenitys\Services\CommonAmenityService;
use App\Modules\Project\Projects\Requests\ProjectCreateRequest;
use App\Modules\Project\Projects\Services\ProjectService;

class ProjectCreateController extends Controller
{
    private $projectService;
    private $amenityService;

    public function __construct(ProjectService $projectService, CommonAmenityService $amenityService)
    {
        $this->middleware('permission:create projects', ['only' => ['get','post']]);
        $this->projectService = $projectService;
        $this->amenityService = $amenityService;
    }

    public function get(){
        $amenity = $this->amenityService->all();
        return view('admin.pages.project.create', compact('amenity'));
    }

    public function post(ProjectCreateRequest $request){

        try {
            //code...
            $project = $this->projectService->create(
                $request->except(['brochure', 'amenity', 'brochure_bg_image'])
            );
            if($request->hasFile('brochure')){
                $this->projectService->saveBrochure($project);
            }
            if($request->hasFile('brochure_bg_image')){
                $this->projectService->saveImage($project);
            }
            $amenities = array();
            foreach ($request->amenity as $key => $value) {
                $amenities[$value] = [
                    'user_id' => auth()->user()->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            $project->amenity()->sync($amenities);
            return response()->json(["message" => "Project created successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
