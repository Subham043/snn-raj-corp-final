<?php

namespace App\Modules\Enquiry\EmpanelmentForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\EmpanelmentForm\Exports\EmpanelmentFormExport;
use Maatwebsite\Excel\Facades\Excel;

class EmpanelmentFormExcelController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:list enquiries', ['only' => ['get']]);
    }

    public function get(){
        return Excel::download(new EmpanelmentFormExport, 'empanelment_form.xlsx');
    }

}
