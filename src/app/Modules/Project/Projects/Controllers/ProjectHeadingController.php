<?php

namespace App\Modules\Project\Projects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\Projects\Requests\ProjectHeadingRequest;
use App\Modules\Project\Projects\Services\ProjectHeadingService;

class ProjectHeadingController extends Controller
{
    private $projectHeadingService;

    public function __construct(ProjectHeadingService $projectHeadingService)
    {
        $this->middleware('permission:list projects', ['only' => ['post']]);
        $this->projectHeadingService = $projectHeadingService;
    }

    public function post(ProjectHeadingRequest $request){
        try {
            //code...
            $this->projectHeadingService->createOrUpdate(
                $request->validated(),
            );
            return response()->json(["message" => "Project heading updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
