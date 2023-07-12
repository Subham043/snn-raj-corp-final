<?php

namespace App\Modules\Campaigns\Services;

use App\Http\Services\CampaignFileService;
use App\Modules\Campaigns\Models\CampaignSpecification;
use App\Modules\Campaigns\Requests\CampaignAmenitiesCreateRequest;
use App\Modules\Campaigns\Requests\CampaignAmenitiesUpdateRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class CampaignSpecificationService
{
    private $campaignSpecificationModel;
    private $path = 'campaigns_specification';

    public function __construct(CampaignSpecification $campaignSpecificationModel)
    {
        $this->campaignSpecificationModel = $campaignSpecificationModel;
    }

    public function getById(Int $id): CampaignSpecification
    {
        return $this->campaignSpecificationModel->findOrFail($id);
    }

    public function paginate(Request $request, Int $limit = 10, Int $campaign_id): LengthAwarePaginator
    {
        if ($request->has('search')) {
            $search = $request->input('search');
            return $this->campaignSpecificationModel->where('campaign_id', $campaign_id)->where('title', 'like', '%' . $search . '%')
            ->orderBy('id', 'DESC')->paginate($limit);
        }
        return $this->campaignSpecificationModel->where('campaign_id', $campaign_id)->orderBy('id', 'DESC')->paginate($limit);
    }

    public function create(CampaignAmenitiesCreateRequest $request, Int $campaign_id): void
    {
        $icon_image = (new CampaignFileService)->save_file($request, 'icon_image', $this->path);
        $this->campaignSpecificationModel->create([
            ...$request->except('icon_image'),
            'icon_image' => $icon_image,
            'campaign_id' => $campaign_id,
        ]);
    }

    public function update(CampaignAmenitiesUpdateRequest $request, CampaignSpecification $data) : void
    {
        $data->update([
            ...$request->except('icon_image'),
        ]);
    }

    public function update_image(CampaignAmenitiesUpdateRequest $request, CampaignSpecification $data) : void
    {
        if($request->hasFile('icon_image')){
            $icon_image = (new CampaignFileService)->save_file($request, 'icon_image', $this->path);
            if($data->icon_image){
                (new CampaignFileService)->delete_file('app/public/'.$this->path.'/'.$data->icon_image);
            }
            $data->update([
                'icon_image' => $icon_image,
            ]);
        }
    }

    public function delete(CampaignSpecification $data): void
    {
        if($data->icon_image){
            (new CampaignFileService)->delete_file('app/public/'.$this->path.'/'.$data->icon_image);
        }
        $data->delete();
    }

}
