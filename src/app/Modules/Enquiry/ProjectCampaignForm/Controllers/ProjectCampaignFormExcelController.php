<?php

namespace App\Modules\Enquiry\ProjectCampaignForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\ProjectCampaignForm\Exports\ProjectCampaignFormExport;
use Maatwebsite\Excel\Facades\Excel;

class ProjectCampaignFormExcelController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:list enquiries', ['only' => ['get']]);
    }

    public function get(){
        return Excel::download(new ProjectCampaignFormExport, 'campaign_form.xlsx');
    }

}
