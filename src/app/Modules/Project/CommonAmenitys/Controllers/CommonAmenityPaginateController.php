<?php

namespace App\Modules\Project\CommonAmenitys\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Project\CommonAmenitys\Services\CommonAmenityService;
use Illuminate\Http\Request;

class CommonAmenityPaginateController extends Controller
{
    private $amenityService;

    public function __construct(CommonAmenityService $amenityService)
    {
        $this->middleware('permission:list projects', ['only' => ['get']]);
        $this->amenityService = $amenityService;
    }

    public function get(Request $request){
        $data = $this->amenityService->paginate($request->total ?? 10);
        return view('admin.pages.project.common_amenity.paginate', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
