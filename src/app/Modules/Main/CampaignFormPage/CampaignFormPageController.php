<?php

namespace App\Modules\Main\CampaignFormPage;

use App\Http\Controllers\Controller;
use App\Http\Services\RateLimitService;
use App\Http\Services\SelldoService;
use App\Modules\Enquiry\CampaignForm\Requests\CampaignFormRequest;
use App\Modules\Enquiry\CampaignForm\Services\CampaignFormService;

class CampaignFormPageController extends Controller
{
    private $campaignFormService;

    public function __construct(
        CampaignFormService $campaignFormService,
    )
    {
        $this->campaignFormService = $campaignFormService;
    }

    public function get(){
        return view('main.pages.campaign_form');
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
            (new SelldoService)->create($request->name, $request->email, $request->phone);
            return response()->json(["message" => "Campaign Enquiry recieved successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }

}
