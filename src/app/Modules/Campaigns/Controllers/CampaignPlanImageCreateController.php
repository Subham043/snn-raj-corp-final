<?php

namespace App\Modules\Campaigns\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Services\CampaignPlanCategoryService;
use App\Modules\Campaigns\Requests\CampaignPlanImageRequest;
use App\Modules\Campaigns\Services\CampaignPlanImageService;

class CampaignPlanImageCreateController extends Controller
{
    private $campaignPlanCategoryService;
    private $campaignGalleryService;

    public function __construct(CampaignPlanImageService $campaignGalleryService, CampaignPlanCategoryService $campaignPlanCategoryService)
    {
        $this->middleware('permission:campaigns', ['only' => ['get','post']]);
        $this->campaignPlanCategoryService = $campaignPlanCategoryService;
        $this->campaignGalleryService = $campaignGalleryService;
    }

    public function get(Int $campaign_id, Int $category_id){
        $this->campaignPlanCategoryService->getById($category_id);
        return view('admin.pages.campaigns.plan_image.create')->with(
            [
                'campaign_id' => $campaign_id,
                'category_id' => $category_id,
            ]
        );
    }

    public function post(CampaignPlanImageRequest $request, Int $campaign_id, Int $category_id){
        $this->campaignPlanCategoryService->getById($category_id);
        try {
            //code...
            $this->campaignGalleryService->create($request, $category_id);
            return redirect()->intended(route('campaign_plan_image_create.get', [$campaign_id, $category_id]))->with('success_status', 'Campaign Plan Image created successfully.');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect(route('campaign_plan_image_create.get', [$campaign_id, $category_id]))->with('error_status', 'Oops! Something went wrong. Please try again!');
        }

    }
}