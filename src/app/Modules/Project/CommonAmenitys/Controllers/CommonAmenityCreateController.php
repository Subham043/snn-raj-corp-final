<?php

namespace App\Modules\Project\CommonAmenitys\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\CommonAmenitys\Requests\CommonAmenityCreateRequest;
use App\Modules\Project\CommonAmenitys\Services\CommonAmenityService;

class CommonAmenityCreateController extends Controller
{
    private $amenityService;

    public function __construct(CommonAmenityService $amenityService)
    {
        $this->middleware('permission:list projects', ['only' => ['get','post']]);
        $this->amenityService = $amenityService;
    }

    public function get(){
        return view('admin.pages.project.common_amenity.create');
    }

    public function post(CommonAmenityCreateRequest $request){

        try {
            //code...
            $amenity = $this->amenityService->create(
                $request->except('image')
            );
            if($request->hasFile('image')){
                $this->amenityService->saveImage($amenity);
            }
            return response()->json(["message" => "Common Amenity created successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
