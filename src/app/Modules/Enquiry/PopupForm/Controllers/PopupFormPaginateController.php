<?php

namespace App\Modules\Enquiry\PopupForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\PopupForm\Services\PopupFormService;
use Illuminate\Http\Request;

class PopupFormPaginateController extends Controller
{
    private $contactFormService;

    public function __construct(PopupFormService $contactFormService)
    {
        $this->middleware('permission:list enquiries', ['only' => ['get']]);
        $this->contactFormService = $contactFormService;
    }

    public function get(Request $request){
        $data = $this->contactFormService->paginate($request->total ?? 10);
        return view('admin.pages.enquiry.popup_form', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
