<?php

namespace App\Modules\Campaigns\Services;

use App\Modules\Campaigns\Models\CampaignConnectivity;
use App\Modules\Campaigns\Requests\CampaignConnectivityRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class CampaignConnectivityService
{
    private $campaignConnectivityModel;

    public function __construct(CampaignConnectivity $campaignConnectivityModel)
    {
        $this->campaignConnectivityModel = $campaignConnectivityModel;
    }

    public function getById(Int $id): CampaignConnectivity
    {
        return $this->campaignConnectivityModel->findOrFail($id);
    }

    public function paginate(Request $request, Int $limit = 10, Int $campaign_id): LengthAwarePaginator
    {
        if ($request->has('search')) {
            $search = $request->input('search');
            return $this->campaignConnectivityModel->where('campaign_id', $campaign_id)->where('title', 'like', '%' . $search . '%')
            ->orderBy('id', 'DESC')->paginate($limit);
        }
        return $this->campaignConnectivityModel->where('campaign_id', $campaign_id)->orderBy('id', 'DESC')->paginate($limit);
    }

    public function create(CampaignConnectivityRequest $request, Int $campaign_id): void
    {
        $this->campaignConnectivityModel->create([
            ...$request->all(),
            'campaign_id' => $campaign_id,
        ]);
    }

    public function update(CampaignConnectivityRequest $request, CampaignConnectivity $data) : void
    {
        $data->update([
            ...$request->all(),
        ]);
    }

    public function delete(CampaignConnectivity $data): void
    {
        $data->delete();
    }

}
