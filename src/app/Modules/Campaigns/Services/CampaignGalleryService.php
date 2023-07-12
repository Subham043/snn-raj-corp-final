<?php

namespace App\Modules\Campaigns\Services;

use App\Http\Services\CampaignFileService;
use App\Modules\Campaigns\Models\CampaignGallery;
use App\Modules\Campaigns\Requests\CampaignGalleryCreateRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CampaignGalleryService
{
    private $campaignGalleryModel;
    private $path = 'campaigns_gallery';

    public function __construct(CampaignGallery $campaignGalleryModel)
    {
        $this->campaignGalleryModel = $campaignGalleryModel;
    }

    public function getById(Int $id): CampaignGallery
    {
        return $this->campaignGalleryModel->findOrFail($id);
    }

    public function paginate(Int $limit = 10, Int $campaign_id): LengthAwarePaginator
    {
        return $this->campaignGalleryModel->where('campaign_id', $campaign_id)->orderBy('id', 'DESC')->paginate($limit);
    }

    public function create(CampaignGalleryCreateRequest $request, Int $campaign_id): void
    {
        $image = (new CampaignFileService)->save_file($request, 'image', $this->path);
        $this->campaignGalleryModel->create([
            'image' => $image,
            'campaign_id' => $campaign_id,
        ]);
    }

    public function delete(CampaignGallery $data): void
    {
        if($data->image){
            (new CampaignFileService)->delete_file('app/public/'.$this->path.'/'.$data->image);
        }
        $data->delete();
    }

}
