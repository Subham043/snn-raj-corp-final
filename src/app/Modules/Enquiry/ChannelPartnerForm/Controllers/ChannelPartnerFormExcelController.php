<?php

namespace App\Modules\Enquiry\ChannelPartnerForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\ChannelPartnerForm\Exports\ChannelPartnerFormExport;
use Maatwebsite\Excel\Facades\Excel;

class ChannelPartnerFormExcelController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:list enquiries', ['only' => ['get']]);
    }

    public function get(){
        return Excel::download(new ChannelPartnerFormExport, 'free_ad_form.xlsx');
    }

}
