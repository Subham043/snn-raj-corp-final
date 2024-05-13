<?php

namespace App\Modules\SiteEnquiryRepresentative\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\SiteEnquiryRepresentative\Requests\SiteEnquiryRepresentativeUpdatePostRequest;
use App\Modules\SiteEnquiryRepresentative\Services\SiteEnquiryRepresentativeService;

class SiteEnquiryRepresentativeUpdateController extends Controller
{
    private $userService;

    public function __construct(SiteEnquiryRepresentativeService $userService)
    {
        $this->middleware('permission:edit users', ['only' => ['get', 'post']]);
        $this->userService = $userService;
    }

    public function get($id){
        $data = $this->userService->getById($id);
        return view('admin.pages.site_enquiry_representative.update', compact(['data']));
    }

    public function post(SiteEnquiryRepresentativeUpdatePostRequest $request, $id){
        $user = $this->userService->getById($id);

        try {
            //code...
            $this->userService->update(
                [...$request->validated()],
                $user
            );
            return redirect()->intended(route('site_enquiry_representative.update.get', $user->id))->with('success_status', 'Representative updated successfully.');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect()->intended(route('site_enquiry_representative.update.get', $user->id))->with('error_status', 'Something went wrong. Please try again');
        }

    }
}