<?php

namespace App\Modules\Project\Accomodations\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\Accomodations\Requests\AccomodationRequest;
use App\Modules\Project\Accomodations\Services\AccomodationService;
use App\Modules\Project\Projects\Services\ProjectService;

class AccomodationCreateController extends Controller
{
    private $accomodationService;
    private $projectService;

    public function __construct(AccomodationService $accomodationService, ProjectService $projectService)
    {
        $this->middleware('permission:list projects', ['only' => ['get','post']]);
        $this->accomodationService = $accomodationService;
        $this->projectService = $projectService;
    }

    public function get($project_id){
        $this->projectService->getById($project_id);
        return view('admin.pages.project.accomodation.create', compact(['project_id']));
    }

    public function post(AccomodationRequest $request, $project_id){

        $this->projectService->getById($project_id);
        try {
            //code...
            $this->accomodationService->create(
                $request->validated(),
                $project_id
            );
            return response()->json(["message" => "Accomodation created successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
