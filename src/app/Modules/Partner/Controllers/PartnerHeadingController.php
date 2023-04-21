<?php

namespace App\Modules\Partner\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Partner\Requests\PartnerHeadingRequest;
use App\Modules\Partner\Services\PartnerHeadingService;

class PartnerHeadingController extends Controller
{
    private $partnerHeadingService;

    public function __construct(PartnerHeadingService $partnerHeadingService)
    {
        $this->middleware('permission:list partners', ['only' => ['post']]);
        $this->partnerHeadingService = $partnerHeadingService;
    }

    public function post(PartnerHeadingRequest $request){
        try {
            //code...
            $this->partnerHeadingService->createOrUpdate(
                $request->validated(),
            );
            return response()->json(["message" => "Partner heading updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
