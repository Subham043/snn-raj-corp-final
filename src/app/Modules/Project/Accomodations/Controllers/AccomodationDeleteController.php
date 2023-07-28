<?php

namespace App\Modules\Project\Accomodations\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\Accomodations\Services\AccomodationService;
use App\Modules\Project\Projects\Services\ProjectService;

class AccomodationDeleteController extends Controller
{
    private $accomodationService;
    private $projectService;

    public function __construct(AccomodationService $accomodationService, ProjectService $projectService)
    {
        $this->middleware('permission:list projects', ['only' => ['get']]);
        $this->accomodationService = $accomodationService;
        $this->projectService = $projectService;
    }

    public function get($project_id, $id){
        $project = $this->projectService->getById($project_id);
        $accomodation = $this->accomodationService->getByIdAndProjectId($id, $project_id);

        try {
            //code...
            $this->accomodationService->delete(
                $accomodation
            );
            return redirect()->back()->with('success_status', 'Accomodation deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
