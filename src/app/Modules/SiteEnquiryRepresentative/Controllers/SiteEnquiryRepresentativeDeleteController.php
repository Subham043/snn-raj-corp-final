<?php

namespace App\Modules\SiteEnquiryRepresentative\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\SiteEnquiryRepresentative\Services\SiteEnquiryRepresentativeService;

class SiteEnquiryRepresentativeDeleteController extends Controller
{
    private $userService;

    public function __construct(SiteEnquiryRepresentativeService $userService)
    {
        $this->middleware('permission:delete users', ['only' => ['get']]);
        $this->userService = $userService;
    }

    public function get($id){
        $user = $this->userService->getById($id);

        try {
            //code...
            $this->userService->delete(
                $user
            );
            return redirect()->back()->with('success_status', 'Representative deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}