<?php

namespace App\Modules\SiteEnquiryExecutive\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\SiteEnquiryExecutive\Services\SiteEnquiryExecutiveService;
use Illuminate\Http\Request;

class SiteEnquiryExecutivePaginateController extends Controller
{
    private $userService;

    public function __construct(SiteEnquiryExecutiveService $userService)
    {
        $this->middleware('permission:list users', ['only' => ['get']]);
        $this->userService = $userService;
    }

    public function get(Request $request){
        $data = $this->userService->paginate($request->total ?? 10);
        return view('admin.pages.site_enquiry_executive.paginate', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
