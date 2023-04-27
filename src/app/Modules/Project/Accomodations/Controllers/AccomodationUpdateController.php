<?php

namespace App\Modules\Project\Accomodations\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\Accomodations\Requests\AccomodationRequest;
use App\Modules\Project\Accomodations\Services\AccomodationService;
use App\Modules\Project\Projects\Services\ProjectService;

class AccomodationUpdateController extends Controller
{
    private $accomodationService;
    private $projectService;

    public function __construct(AccomodationService $accomodationService, ProjectService $projectService)
    {
        $this->middleware('permission:list projects', ['only' => ['get','post']]);
        $this->accomodationService = $accomodationService;
        $this->projectService = $projectService;
    }

    public function get($project_id, $id){
        $this->projectService->getById($project_id);
        $data = $this->accomodationService->getByIdAndProjectId($id, $project_id);
        return view('admin.pages.project.accomodation.update', compact('data', 'project_id'));
    }

    public function post(AccomodationRequest $request, $project_id, $id){
        $project = $this->projectService->getById($project_id);
        $accomodation = $this->accomodationService->getByIdAndProjectId($id, $project_id);
        try {
            //code...
            $this->accomodationService->update(
                $request->validated(),
                $accomodation
            );
            $this->projectService->clear_cache($project);
            return response()->json(["message" => "Accomodation updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
