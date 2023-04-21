<?php

namespace App\Modules\Counter\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Counter\Requests\CounterHeadingRequest;
use App\Modules\Counter\Services\CounterHeadingService;

class CounterHeadingController extends Controller
{
    private $counterHeadingService;

    public function __construct(CounterHeadingService $counterHeadingService)
    {
        $this->middleware('permission:list counters', ['only' => ['post']]);
        $this->counterHeadingService = $counterHeadingService;
    }

    public function post(CounterHeadingRequest $request){
        try {
            //code...
            $this->counterHeadingService->createOrUpdate(
                $request->validated(),
            );
            return response()->json(["message" => "Counter heading updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
