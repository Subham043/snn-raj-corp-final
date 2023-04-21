<?php

namespace App\Modules\TeamMember\Management\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\TeamMember\Management\Requests\ManagementHeadingRequest;
use App\Modules\TeamMember\Management\Services\ManagementHeadingService;

class ManagementHeadingController extends Controller
{
    private $managementHeadingService;

    public function __construct(ManagementHeadingService $managementHeadingService)
    {
        $this->middleware('permission:list team member managements', ['only' => ['post']]);
        $this->managementHeadingService = $managementHeadingService;
    }

    public function post(ManagementHeadingRequest $request){
        try {
            //code...
            $this->managementHeadingService->createOrUpdate(
                $request->validated(),
            );
            return response()->json(["message" => "Management heading updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
