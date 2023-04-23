<?php

namespace App\Modules\Project\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\Projects\Requests\ProjectUpdateRequest;
use App\Modules\Project\Projects\Services\ProjectService;

class ProjectUpdateController extends Controller
{
    private $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->middleware('permission:edit projects', ['only' => ['get','post']]);
        $this->projectService = $projectService;
    }

    public function get($id){
        $data = $this->projectService->getById($id);
        return view('admin.pages.project.update', compact('data'));
    }

    public function post(ProjectUpdateRequest $request, $id){
        $project = $this->projectService->getById($id);
        try {
            //code...
            $this->projectService->update(
                $request->except('brochure'),
                $project
            );
            if($request->hasFile('brochure')){
                $this->projectService->saveBrochure($project);
            }
            return response()->json(["message" => "Project updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
