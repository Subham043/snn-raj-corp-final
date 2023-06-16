<?php

namespace App\Modules\Enquiry\CareerForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\CareerForm\Exports\CareerFormExport;
use Maatwebsite\Excel\Facades\Excel;

class CareerFormExcelController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:list enquiries', ['only' => ['get']]);
    }

    public function get(){
        return Excel::download(new CareerFormExport, 'career_form.xlsx');
    }

}
