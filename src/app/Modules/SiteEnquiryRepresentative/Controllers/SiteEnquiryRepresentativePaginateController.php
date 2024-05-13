<?php

namespace App\Modules\SiteEnquiryRepresentative\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\SiteEnquiryRepresentative\Services\SiteEnquiryRepresentativeService;
use Illuminate\Http\Request;

class SiteEnquiryRepresentativePaginateController extends Controller
{
    private $userService;

    public function __construct(SiteEnquiryRepresentativeService $userService)
    {
        $this->middleware('permission:list users', ['only' => ['get']]);
        $this->userService = $userService;
    }

    public function get(Request $request){
        $data = $this->userService->paginate($request->total ?? 10);
        return view('admin.pages.site_enquiry_representative.paginate', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
