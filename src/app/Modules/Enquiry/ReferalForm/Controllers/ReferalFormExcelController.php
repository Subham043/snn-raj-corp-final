<?php

namespace App\Modules\Enquiry\ReferalForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\ReferalForm\Exports\ReferalFormExport;
use Maatwebsite\Excel\Facades\Excel;

class ReferalFormExcelController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:list enquiries', ['only' => ['get']]);
    }

    public function get(){
        return Excel::download(new ReferalFormExport, 'referal_form.xlsx');
    }

}
