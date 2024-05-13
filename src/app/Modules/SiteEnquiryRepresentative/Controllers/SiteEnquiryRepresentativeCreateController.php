<?php

namespace App\Modules\SiteEnquiryRepresentative\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\SiteEnquiryRepresentative\Requests\SiteEnquiryRepresentativeCreatePostRequest;
use App\Modules\SiteEnquiryRepresentative\Services\SiteEnquiryRepresentativeService;

class SiteEnquiryRepresentativeCreateController extends Controller
{
    private $userService;

    public function __construct(SiteEnquiryRepresentativeService $userService)
    {
        $this->middleware('permission:create users', ['only' => ['get','post']]);
        $this->userService = $userService;
    }

    public function get(){
        return view('admin.pages.site_enquiry_representative.create');
    }

    public function post(SiteEnquiryRepresentativeCreatePostRequest $request){

        try {
            //code...
            $this->userService->create(
                $request->validated()
            );
            return redirect()->intended(route('site_enquiry_representative.create.get'))->with('success_status', 'Representative created successfully.');
        } catch (\Throwable $th) {
            return redirect()->intended(route('site_enquiry_representative.create.get'))->with('error_status', 'Something went wrong. Please try again');
        }

    }
}