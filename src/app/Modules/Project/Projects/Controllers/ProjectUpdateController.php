<?php

namespace App\Modules\Project\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\CommonAmenitys\Services\CommonAmenityService;
use App\Modules\Project\Projects\Requests\ProjectUpdateRequest;
use App\Modules\Project\Projects\Services\ProjectService;

class ProjectUpdateController extends Controller
{
    private $projectService;
    private $amenityService;

    public function __construct(ProjectService $projectService, CommonAmenityService $amenityService)
    {
        $this->middleware('permission:edit projects', ['only' => ['get','post']]);
        $this->projectService = $projectService;
        $this->amenityService = $amenityService;
    }

    public function get($id){
        $data = $this->projectService->getById($id);
        $amenity = $this->amenityService->all();
        $amenities =$data->amenity->pluck('id')->toArray();
        return view('admin.pages.project.update', compact(['data', 'amenity', 'amenities']));
    }

    public function post(ProjectUpdateRequest $request, $id){
        $project = $this->projectService->getById($id);
        try {
            //code...
            $this->projectService->update(
                $request->except(['brochure', 'amenity', 'brochure_bg_image', 'home_image']),
                $project
            );
            if($request->hasFile('brochure')){
                $this->projectService->saveBrochure($project);
            }
            if($request->hasFile('brochure_bg_image')){
                $this->projectService->saveImage($project);
            }
            if($request->hasFile('home_image')){
                $this->projectService->saveHomeImage($project);
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
            return response()->json(["message" => "Project updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
