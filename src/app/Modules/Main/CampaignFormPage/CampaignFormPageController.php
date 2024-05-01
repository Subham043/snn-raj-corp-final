<?php

namespace App\Modules\Main\CampaignFormPage;

use App\Http\Controllers\Controller;
use App\Http\Services\ParamantraService;
use App\Http\Services\RateLimitService;
use App\Modules\Enquiry\CampaignForm\Requests\CampaignFormRequest;
use App\Modules\Enquiry\CampaignForm\Services\CampaignFormService;
use App\Modules\Project\Projects\Services\ProjectService;

class CampaignFormPageController extends Controller
{
    private $campaignFormService;
    private $projectService;

    public function __construct(
        CampaignFormService $campaignFormService,
        ProjectService $projectService,
    )
    {
        $this->campaignFormService = $campaignFormService;
        $this->projectService = $projectService;
    }

    public function get(){
        $projects = $this->projectService->main_all();
        return view('main.pages.campaign_form', compact('projects'));
    }

    public function post(CampaignFormRequest $request){
        $project = $this->projectService->getById($request->project);
        try {
            //code...
            $this->campaignFormService->create(
                [
                    ...$request->except('project'),
                    'ip_address' => $request->ip(),
                    'project' => $project->name,
                    'source' => 'Organic',
                ]
            );
            (new RateLimitService($request))->clearRateLimit();
            $response = (new ParamantraService)->free_ad_form_create($request->name, $request->email, $request->phone, 'Organic', $request->campaign, $project->name);
            return response()->json(["message" => $response], 201);
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }

}