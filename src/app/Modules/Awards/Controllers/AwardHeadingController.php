<?php

namespace App\Modules\Awards\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Awards\Requests\AwardHeadingRequest;
use App\Modules\Awards\Services\AwardHeadingService;

class AwardHeadingController extends Controller
{
    private $awardHeadingService;

    public function __construct(AwardHeadingService $awardHeadingService)
    {
        $this->middleware('permission:list awards', ['only' => ['post']]);
        $this->awardHeadingService = $awardHeadingService;
    }

    public function post(AwardHeadingRequest $request){
        try {
            //code...
            $this->awardHeadingService->createOrUpdate(
                $request->validated(),
            );
            return response()->json(["message" => "Award heading updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
