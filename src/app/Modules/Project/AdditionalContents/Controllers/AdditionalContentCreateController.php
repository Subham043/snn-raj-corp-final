<?php

namespace App\Modules\Project\AdditionalContents\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\AdditionalContents\Requests\AdditionalContentCreateRequest;
use App\Modules\Project\AdditionalContents\Services\AdditionalContentService;
use App\Modules\Project\Projects\Services\ProjectService;

class AdditionalContentCreateController extends Controller
{
    private $additionalContentService;
    private $projectService;

    public function __construct(AdditionalContentService $additionalContentService, ProjectService $projectService)
    {
        $this->middleware('permission:list projects', ['only' => ['get','post']]);
        $this->additionalContentService = $additionalContentService;
        $this->projectService = $projectService;
    }

    public function get($project_id){
        $this->projectService->getById($project_id);
        return view('admin.pages.project.additional_content.create', compact(['project_id']));
    }

    public function post(AdditionalContentCreateRequest $request, $project_id){

        $project = $this->projectService->getById($project_id);
        try {
            //code...
            $additional_content = $this->additionalContentService->create(
                $request->except('image'),
                $project_id
            );
            if($request->hasFile('image')){
                $this->additionalContentService->saveImage($additional_content);
            }
            $this->projectService->clear_cache($project);
            return response()->json(["message" => "Additional Content created successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
