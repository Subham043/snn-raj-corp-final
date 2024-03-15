<?php

namespace App\Modules\Main\ChannelPartnerFormPage;

use App\Http\Controllers\Controller;
use App\Http\Services\ParamantraService;
use App\Http\Services\RateLimitService;
use App\Modules\Enquiry\ChannelPartnerForm\Requests\ChannelPartnerFormRequest;
use App\Modules\Enquiry\ChannelPartnerForm\Services\ChannelPartnerFormService;
use App\Modules\Project\Projects\Services\ProjectService;

class ChannelPartnerFormPageController extends Controller
{
    private $freeAdFormService;
    private $projectService;

    public function __construct(
        ChannelPartnerFormService $freeAdFormService,
        ProjectService $projectService,
    )
    {
        $this->freeAdFormService = $freeAdFormService;
        $this->projectService = $projectService;
    }

    public function get(){
        $projects = $this->projectService->main_all();
        return view('main.pages.channel_partner_form', compact('projects'));
    }

    public function post(ChannelPartnerFormRequest $request){
        $project = $this->projectService->getById($request->project);
        try {
            //code...
            $this->freeAdFormService->create(
                [
                    ...$request->except('project'),
                    'ip_address' => $request->ip(),
                    'executive_name' => 'Geeta',
                    'project' => $project->projectId
                ]
            );
            (new RateLimitService($request))->clearRateLimit();
            $response = (new ParamantraService)->campaign_form_create($request->name, $request->email, $request->phone, $request->source, $project->name, 'Geeta');
            return response()->json(["message" => $response], 201);
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }

}
