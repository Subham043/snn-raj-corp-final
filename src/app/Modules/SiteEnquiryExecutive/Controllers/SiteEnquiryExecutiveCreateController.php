<?php

namespace App\Modules\SiteEnquiryExecutive\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\SiteEnquiryExecutive\Requests\SiteEnquiryExecutiveCreatePostRequest;
use App\Modules\SiteEnquiryExecutive\Services\SiteEnquiryExecutiveService;

class SiteEnquiryExecutiveCreateController extends Controller
{
    private $userService;

    public function __construct(SiteEnquiryExecutiveService $userService)
    {
        $this->middleware('permission:create users', ['only' => ['get','post']]);
        $this->userService = $userService;
    }

    public function get(){
        return view('admin.pages.site_enquiry_executive.create');
    }

    public function post(SiteEnquiryExecutiveCreatePostRequest $request){

        try {
            //code...
            $this->userService->create(
                $request->validated()
            );
            return redirect()->intended(route('site_enquiry_executive.create.get'))->with('success_status', 'Executive created successfully.');
        } catch (\Throwable $th) {
            return redirect()->intended(route('site_enquiry_executive.create.get'))->with('error_status', 'Something went wrong. Please try again');
        }

    }
}