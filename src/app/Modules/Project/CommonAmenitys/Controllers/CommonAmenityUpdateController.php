<?php

namespace App\Modules\Project\CommonAmenitys\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\CommonAmenitys\Requests\CommonAmenityUpdateRequest;
use App\Modules\Project\CommonAmenitys\Services\CommonAmenityService;

class CommonAmenityUpdateController extends Controller
{
    private $amenityService;

    public function __construct(CommonAmenityService $amenityService)
    {
        $this->middleware('permission:list projects', ['only' => ['get','post']]);
        $this->amenityService = $amenityService;
    }

    public function get($id){
        $data = $this->amenityService->getById($id);
        return view('admin.pages.project.common_amenity.update', compact('data'));
    }

    public function post(CommonAmenityUpdateRequest $request, $id){
        $amenity = $this->amenityService->getById($id);
        try {
            //code...
            $this->amenityService->update(
                $request->except('image'),
                $amenity
            );
            if($request->hasFile('image')){
                $this->amenityService->saveImage($amenity);
            }
            return response()->json(["message" => "Common Amenity updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
