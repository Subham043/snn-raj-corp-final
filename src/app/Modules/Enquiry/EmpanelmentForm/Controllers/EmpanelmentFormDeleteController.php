<?php

namespace App\Modules\Enquiry\EmpanelmentForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\EmpanelmentForm\Services\EmpanelmentFormService;

class EmpanelmentFormDeleteController extends Controller
{
    private $empanelmentFormService;

    public function __construct(EmpanelmentFormService $empanelmentFormService)
    {
        $this->middleware('permission:delete enquiries', ['only' => ['get']]);
        $this->empanelmentFormService = $empanelmentFormService;
    }

    public function get($id){
        $empanelment = $this->empanelmentFormService->getById($id);

        try {
            //code...
            $this->empanelmentFormService->delete(
                $empanelment
            );
            return redirect()->back()->with('success_status', 'Empanelment Form deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
