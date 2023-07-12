<?php

namespace App\Modules\Campaigns\Services;

use App\Http\Services\CampaignFileService;
use App\Modules\Campaigns\Models\CampaignPlanImage;
use App\Modules\Campaigns\Requests\CampaignPlanImageRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CampaignPlanImageService
{
    private $campaignPlanImageModel;
    private $path = 'campaigns_plan_image';

    public function __construct(CampaignPlanImage $campaignPlanImageModel)
    {
        $this->campaignPlanImageModel = $campaignPlanImageModel;
    }

    public function getById(Int $id): CampaignPlanImage
    {
        return $this->campaignPlanImageModel->findOrFail($id);
    }

    public function paginate(Int $limit = 10, Int $category_id): LengthAwarePaginator
    {
        return $this->campaignPlanImageModel->where('category_id', $category_id)->orderBy('id', 'DESC')->paginate($limit);
    }

    public function create(CampaignPlanImageRequest $request, Int $category_id): void
    {
        $image = (new CampaignFileService)->save_file($request, 'image', $this->path);
        $this->campaignPlanImageModel->create([
            'image' => $image,
            'category_id' => $category_id,
        ]);
    }

    public function delete(CampaignPlanImage $data): void
    {
        if($data->image){
            (new CampaignFileService)->delete_file('app/public/'.$this->path.'/'.$data->image);
        }
        $data->delete();
    }

}
