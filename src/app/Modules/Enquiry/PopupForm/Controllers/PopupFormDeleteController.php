<?php

namespace App\Modules\Enquiry\PopupForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\PopupForm\Services\PopupFormService;

class PopupFormDeleteController extends Controller
{
    private $contactFormService;

    public function __construct(PopupFormService $contactFormService)
    {
        $this->middleware('permission:delete enquiries', ['only' => ['get']]);
        $this->contactFormService = $contactFormService;
    }

    public function get($id){
        $contact = $this->contactFormService->getById($id);

        try {
            //code...
            $this->contactFormService->delete(
                $contact
            );
            return redirect()->back()->with('success_status', 'Contact Form deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
