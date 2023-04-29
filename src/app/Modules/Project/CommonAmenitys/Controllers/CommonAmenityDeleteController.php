<?php

namespace App\Modules\Project\CommonAmenitys\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\CommonAmenitys\Services\CommonAmenityService;

class CommonAmenityDeleteController extends Controller
{
    private $amenityService;

    public function __construct(CommonAmenityService $amenityService)
    {
        $this->middleware('permission:list projects', ['only' => ['get']]);
        $this->amenityService = $amenityService;
    }

    public function get($id){
        $amenity = $this->amenityService->getById($id);

        try {
            //code...
            $this->amenityService->delete(
                $amenity
            );
            return redirect()->back()->with('success_status', 'Common Amenity deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
