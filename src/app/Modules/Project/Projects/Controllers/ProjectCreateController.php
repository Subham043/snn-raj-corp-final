<?php

namespace App\Modules\Project\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\Projects\Requests\ProjectCreateRequest;
use App\Modules\Project\Projects\Services\ProjectService;

class ProjectCreateController extends Controller
{
    private $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->middleware('permission:create projects', ['only' => ['get','post']]);
        $this->projectService = $projectService;
    }

    public function get(){
        return view('admin.pages.project.create');
    }

    public function post(ProjectCreateRequest $request){

        try {
            //code...
            $project = $this->projectService->create(
                $request->except('brochure')
            );
            if($request->hasFile('brochure')){
                $this->projectService->saveBrochure($project);
            }
            return response()->json(["message" => "Project created successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
