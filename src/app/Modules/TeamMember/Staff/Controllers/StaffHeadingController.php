<?php

namespace App\Modules\TeamMember\Staff\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\TeamMember\Staff\Requests\StaffHeadingRequest;
use App\Modules\TeamMember\Staff\Services\StaffHeadingService;

class StaffHeadingController extends Controller
{
    private $staffHeadingService;

    public function __construct(StaffHeadingService $staffHeadingService)
    {
        $this->middleware('permission:list team member staffs', ['only' => ['post']]);
        $this->staffHeadingService = $staffHeadingService;
    }

    public function post(StaffHeadingRequest $request){
        try {
            //code...
            $this->staffHeadingService->createOrUpdate(
                $request->validated(),
            );
            return response()->json(["message" => "Staff heading updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
