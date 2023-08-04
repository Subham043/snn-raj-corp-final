<?php

namespace App\Modules\Campaigns\Services;

use App\Enums\PublishStatusEnum;
use App\Http\Services\CampaignFileService;
use App\Modules\Campaigns\Models\Campaign;
use App\Modules\Campaigns\Requests\CampaignCreateRequest;
use App\Modules\Campaigns\Requests\CampaignUpdateRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class CampaignService
{
    private $campaignModel;
    private $path = 'campaigns';

    public function __construct(Campaign $campaignModel)
    {
        $this->campaignModel = $campaignModel;
    }

    public function all(): Collection
    {
        return $this->campaignModel->orderBy('id', 'DESC')->get();
    }

    public function paginate(Request $request, Int $limit = 10): LengthAwarePaginator
    {
        if ($request->has('search')) {
            $search = $request->input('search');
            return $this->campaignModel->where('name', 'like', '%' . $search . '%')
            ->orWhere('slug', 'like', '%' . $search . '%')->orderBy('id', 'DESC')->paginate($limit);
        }
        return $this->campaignModel->orderBy('id', 'DESC')->paginate($limit);
    }

    public function getById(Int $id): Campaign
    {
        return $this->campaignModel->findOrFail($id);
    }

    public function getBySlug(String $slug): Campaign
    {
        return $this->campaignModel->with(['CampaignAbout', 'CampaignThank', 'CampaignGallery', 'CampaignAmenities', 'CampaignLocation', 'CampaignTable', 'CampaignPlanCategory.CampaignPlanImage', 'CampaignBanner', 'CampaignConnectivity'])->where('publish_status', PublishStatusEnum::ACTIVE->label())->where('slug', $slug)->firstOrFail();
    }

    public function getPreview(Int $id): Campaign
    {
        return $this->campaignModel->with(['CampaignAbout', 'CampaignGallery', 'CampaignAmenities', 'CampaignLocation', 'CampaignTable', 'CampaignPlanCategory.CampaignPlanImage', 'CampaignBanner', 'CampaignConnectivity'])->findOrFail($id);
    }

    public function create(CampaignCreateRequest $request): void
    {
        $header_logo = (new CampaignFileService)->save_file($request, 'header_logo', $this->path);
        $footer_logo = (new CampaignFileService)->save_file($request, 'footer_logo', $this->path);
        $og_image = (new CampaignFileService)->save_file($request, 'og_image', $this->path);
        $brochure_bg_image = (new CampaignFileService)->save_file($request, 'brochure_bg_image', $this->path);
        $this->campaignModel->create([
            ...$request->except('header_logo', 'footer_logo', 'og_image', 'brochure_bg_image'),
            'header_logo' => $header_logo,
            'footer_logo' => $footer_logo,
            'og_image' => $og_image,
            'brochure_bg_image' => $brochure_bg_image,
        ]);
    }

    public function updateHeading(array $value, Campaign $data) : void
    {
        $data->update([
            ...$value,
        ]);
    }

    public function update(CampaignUpdateRequest $request, Campaign $data) : void
    {
        $data->update([
            ...$request->except('header_logo', 'footer_logo', 'og_image', 'brochure_bg_image'),
        ]);
    }

    public function update_image(CampaignUpdateRequest $request, Campaign $data) : void
    {
        if($request->hasFile('header_logo')){
            $header_logo = (new CampaignFileService)->save_file($request, 'header_logo', $this->path);
            if($data->header_logo){
                (new CampaignFileService)->delete_file('app/public/'.$this->path.'/'.$data->header_logo);
            }
            $data->update([
                'header_logo' => $header_logo,
            ]);
        }
        if($request->hasFile('footer_logo')){
            $footer_logo = (new CampaignFileService)->save_file($request, 'footer_logo', $this->path);
            if($data->footer_logo){
                (new CampaignFileService)->delete_file('app/public/'.$this->path.'/'.$data->footer_logo);
            }
            $data->update([
                'footer_logo' => $footer_logo,
            ]);
        }
        if($request->hasFile('og_image')){
            $og_image = (new CampaignFileService)->save_file($request, 'og_image', $this->path);
            if($data->og_image){
                (new CampaignFileService)->delete_file('app/public/'.$this->path.'/'.$data->og_image);
            }
            $data->update([
                'og_image' => $og_image,
            ]);
        }
        if($request->hasFile('brochure_bg_image')){
            $brochure_bg_image = (new CampaignFileService)->save_file($request, 'brochure_bg_image', $this->path);
            if($data->brochure_bg_image){
                (new CampaignFileService)->delete_file('app/public/'.$this->path.'/'.$data->brochure_bg_image);
            }
            $data->update([
                'brochure_bg_image' => $brochure_bg_image,
            ]);
        }
    }

    public function delete(Campaign $data): void
    {
        if($data->header_logo){
            (new CampaignFileService)->delete_file('app/public/'.$this->path.'/'.$data->header_logo);
        }
        if($data->footer_logo){
            (new CampaignFileService)->delete_file('app/public/'.$this->path.'/'.$data->footer_logo);
        }
        if(!empty($data->og_image)){
            (new CampaignFileService)->delete_file('app/public/'.$this->path.'/'.$data->og_image);
        }
        if(!empty($data->brochure_bg_image)){
            (new CampaignFileService)->delete_file('app/public/'.$this->path.'/'.$data->brochure_bg_image);
        }
        $data->delete();
    }
}
