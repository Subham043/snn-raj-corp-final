<?php

namespace App\Modules\SiteEnquiryExecutive\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\SiteEnquiryExecutive\Requests\SiteEnquiryExecutiveUpdatePostRequest;
use App\Modules\SiteEnquiryExecutive\Services\SiteEnquiryExecutiveService;

class SiteEnquiryExecutiveUpdateController extends Controller
{
    private $userService;

    public function __construct(SiteEnquiryExecutiveService $userService)
    {
        $this->middleware('permission:edit users', ['only' => ['get', 'post']]);
        $this->userService = $userService;
    }

    public function get($id){
        $data = $this->userService->getById($id);
        return view('admin.pages.site_enquiry_executive.update', compact(['data']));
    }

    public function post(SiteEnquiryExecutiveUpdatePostRequest $request, $id){
        $user = $this->userService->getById($id);
        $password = empty($request->password) ? [] : $request->only('password');

        try {
            //code...
            $this->userService->update(
                [...$request->except(['password']), ...$password],
                $user
            );
            return redirect()->intended(route('site_enquiry_executive.update.get', $user->id))->with('success_status', 'Executive updated successfully.');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect()->intended(route('site_enquiry_executive.update.get', $user->id))->with('error_status', 'Something went wrong. Please try again');
        }

    }
}