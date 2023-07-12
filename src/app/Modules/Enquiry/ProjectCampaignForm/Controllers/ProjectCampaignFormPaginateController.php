<?php

namespace App\Modules\Enquiry\ProjectCampaignForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\ProjectCampaignForm\Services\ProjectCampaignFormService;
use Illuminate\Http\Request;

class ProjectCampaignFormPaginateController extends Controller
{
    private $campaignFormService;

    public function __construct(ProjectCampaignFormService $campaignFormService)
    {
        $this->middleware('permission:list enquiries', ['only' => ['get']]);
        $this->campaignFormService = $campaignFormService;
    }

    public function get(Request $request){
        $data = $this->campaignFormService->paginate($request->total ?? 10);
        return view('admin.pages.enquiry.project_campaign_form', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
