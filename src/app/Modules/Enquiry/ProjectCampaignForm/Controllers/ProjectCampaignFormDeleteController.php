<?php

namespace App\Modules\Enquiry\ProjectCampaignForm\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Enquiry\ProjectCampaignForm\Services\ProjectCampaignFormService;

class ProjectCampaignFormDeleteController extends Controller
{
    private $campaignFormService;

    public function __construct(ProjectCampaignFormService $campaignFormService)
    {
        $this->middleware('permission:delete enquiries', ['only' => ['get']]);
        $this->campaignFormService = $campaignFormService;
    }

    public function get($id){
        $campaign = $this->campaignFormService->getById($id);

        try {
            //code...
            $this->campaignFormService->delete(
                $campaign
            );
            return redirect()->back()->with('success_status', 'Campaign Form deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
