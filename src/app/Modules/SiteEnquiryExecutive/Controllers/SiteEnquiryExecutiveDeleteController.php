<?php

namespace App\Modules\SiteEnquiryExecutive\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\SiteEnquiryExecutive\Services\SiteEnquiryExecutiveService;

class SiteEnquiryExecutiveDeleteController extends Controller
{
    private $userService;

    public function __construct(SiteEnquiryExecutiveService $userService)
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
            return redirect()->back()->with('success_status', 'Executive deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}