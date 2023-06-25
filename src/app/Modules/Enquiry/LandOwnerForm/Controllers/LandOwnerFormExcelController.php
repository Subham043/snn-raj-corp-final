<?php

namespace App\Modules\Enquiry\LandOwnerForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\LandOwnerForm\Exports\LandOwnerFormExport;
use Maatwebsite\Excel\Facades\Excel;

class LandOwnerFormExcelController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:list enquiries', ['only' => ['get']]);
    }

    public function get(){
        return Excel::download(new LandOwnerFormExport, 'land_owner_form.xlsx');
    }

}
