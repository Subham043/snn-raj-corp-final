<?php

namespace App\Modules\Main\CampaignFormPage;

use App\Http\Controllers\Controller;
use App\Http\Services\RateLimitService;
use App\Http\Services\SelldoService;
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

        try {
            //code...
            $this->campaignFormService->create(
                [
                    ...$request->validated(),
                    'ip_address' => $request->ip(),
                ]
            );
            (new RateLimitService($request))->clearRateLimit();
            (new SelldoService)->free_ad_create($request->name, $request->email, $request->phone, $request->source, $request->project);
            return response()->json(["message" => "Free Ad Enquiry recieved successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }

}
