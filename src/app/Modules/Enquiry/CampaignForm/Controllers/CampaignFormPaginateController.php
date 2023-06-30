<?php

namespace App\Modules\Enquiry\CampaignForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\CampaignForm\Services\CampaignFormService;
use Illuminate\Http\Request;

class CampaignFormPaginateController extends Controller
{
    private $campaignFormService;

    public function __construct(CampaignFormService $campaignFormService)
    {
        $this->middleware('permission:list enquiries', ['only' => ['get']]);
        $this->campaignFormService = $campaignFormService;
    }

    public function get(Request $request){
        $data = $this->campaignFormService->paginate($request->total ?? 10);
        return view('admin.pages.enquiry.campaign_form', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
