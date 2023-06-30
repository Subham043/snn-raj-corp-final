<?php

namespace App\Modules\Enquiry\CampaignForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\CampaignForm\Exports\CampaignFormExport;
use Maatwebsite\Excel\Facades\Excel;

class CampaignFormExcelController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:list enquiries', ['only' => ['get']]);
    }

    public function get(){
        return Excel::download(new CampaignFormExport, 'campaign_form.xlsx');
    }

}
