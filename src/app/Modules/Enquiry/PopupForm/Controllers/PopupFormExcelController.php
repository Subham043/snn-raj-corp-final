<?php

namespace App\Modules\Enquiry\PopupForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\PopupForm\Exports\PopupFormExport;
use Maatwebsite\Excel\Facades\Excel;

class PopupFormExcelController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:list enquiries', ['only' => ['get']]);
    }

    public function get(){
        return Excel::download(new PopupFormExport, 'contact_form.xlsx');
    }

}
