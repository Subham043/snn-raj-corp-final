<?php

namespace App\Modules\Project\AdditionalContents\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\AdditionalContents\Requests\AdditionalContentUpdateRequest;
use App\Modules\Project\AdditionalContents\Services\AdditionalContentService;
use App\Modules\Project\Projects\Services\ProjectService;

class AdditionalContentUpdateController extends Controller
{
    private $additionalContentService;
    private $projectService;

    public function __construct(AdditionalContentService $additionalContentService, ProjectService $projectService)
    {
        $this->middleware('permission:list projects', ['only' => ['get','post']]);
        $this->additionalContentService = $additionalContentService;
        $this->projectService = $projectService;
    }

    public function get($project_id, $id){
        $this->projectService->getById($project_id);
        $data = $this->additionalContentService->getByIdAndProjectId($id, $project_id);
        return view('admin.pages.project.additional_content.update', compact('data', 'project_id'));
    }

    public function post(AdditionalContentUpdateRequest $request, $project_id, $id){
        $this->projectService->getById($project_id);
        $additional_content = $this->additionalContentService->getByIdAndProjectId($id, $project_id);
        try {
            //code...
            $this->additionalContentService->update(
                $request->except('image'),
                $additional_content
            );
            if($request->hasFile('image')){
                $this->additionalContentService->saveImage($additional_content);
            }
            return response()->json(["message" => "AdditionalContent updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
