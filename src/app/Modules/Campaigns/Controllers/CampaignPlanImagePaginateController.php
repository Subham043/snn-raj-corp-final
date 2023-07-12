<?php

namespace App\Modules\Campaigns\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Campaigns\Services\CampaignPlanImageService;
use App\Modules\Campaigns\Services\CampaignPlanCategoryService;

class CampaignPlanImagePaginateController extends Controller
{
    private $campaignPlanImageService;
    private $campaignPlanCategoryService;

    public function __construct(CampaignPlanImageService $campaignPlanImageService, CampaignPlanCategoryService $campaignPlanCategoryService)
    {
        $this->middleware('permission:campaigns', ['only' => ['get','post']]);
        $this->campaignPlanImageService = $campaignPlanImageService;
        $this->campaignPlanCategoryService = $campaignPlanCategoryService;
    }

    public function get(Int $campaign_id, Int $category_id){
        $campaign = $this->campaignPlanCategoryService->getById($category_id);
        $data = $this->campaignPlanImageService->paginate(10, $category_id);
        return view('admin.pages.campaigns.plan_image.paginate')->with(
            [
                'data' => $data,
                'campaign' => $campaign,
                'campaign_id' => $campaign_id,
                'category_id' => $category_id,
            ]
        );
    }
}
