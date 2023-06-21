<?php

namespace App\Modules\Enquiry\EmpanelmentForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\EmpanelmentForm\Services\EmpanelmentFormService;
use Illuminate\Http\Request;

class EmpanelmentFormPaginateController extends Controller
{
    private $empanelmentFormService;

    public function __construct(EmpanelmentFormService $empanelmentFormService)
    {
        $this->middleware('permission:list enquiries', ['only' => ['get']]);
        $this->empanelmentFormService = $empanelmentFormService;
    }

    public function get(Request $request){
        $data = $this->empanelmentFormService->paginate($request->total ?? 10);
        return view('admin.pages.enquiry.empanelment_form', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
