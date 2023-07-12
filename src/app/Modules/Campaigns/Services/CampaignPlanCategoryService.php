<?php

namespace App\Modules\Campaigns\Services;

use App\Modules\Campaigns\Models\CampaignPlanCategory;
use App\Modules\Campaigns\Requests\CampaignPlanCategoryRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class CampaignPlanCategoryService
{
    private $campaignPlanCategoryModel;

    public function __construct(CampaignPlanCategory $campaignPlanCategoryModel)
    {
        $this->campaignPlanCategoryModel = $campaignPlanCategoryModel;
    }

    public function getById(Int $id): CampaignPlanCategory
    {
        return $this->campaignPlanCategoryModel->findOrFail($id);
    }

    public function paginate(Request $request, Int $limit = 10, Int $campaign_id): LengthAwarePaginator
    {
        if ($request->has('search')) {
            $search = $request->input('search');
            return $this->campaignPlanCategoryModel->where('campaign_id', $campaign_id)->where('name', 'like', '%' . $search . '%')
            ->orderBy('id', 'DESC')->paginate($limit);
        }
        return $this->campaignPlanCategoryModel->where('campaign_id', $campaign_id)->orderBy('id', 'DESC')->paginate($limit);
    }

    public function create(CampaignPlanCategoryRequest $request, Int $campaign_id): void
    {
        $this->campaignPlanCategoryModel->create([
            ...$request->all(),
            'campaign_id' => $campaign_id
        ]);
    }

    public function update(CampaignPlanCategoryRequest $request, CampaignPlanCategory $data) : void
    {
        $data->update([
            ...$request->all(),
        ]);
    }

    public function delete(CampaignPlanCategory $data): void
    {
        $data->delete();
    }

}
