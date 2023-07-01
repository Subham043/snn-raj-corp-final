<?php

namespace App\Modules\Enquiry\FreeAdForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\FreeAdForm\Exports\FreeAdFormExport;
use Maatwebsite\Excel\Facades\Excel;

class FreeAdFormExcelController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:list enquiries', ['only' => ['get']]);
    }

    public function get(){
        return Excel::download(new FreeAdFormExport, 'free_ad_form.xlsx');
    }

}
