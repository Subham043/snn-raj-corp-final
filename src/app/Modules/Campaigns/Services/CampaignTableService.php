<?php

namespace App\Modules\Campaigns\Services;

use App\Modules\Campaigns\Models\CampaignTable;
use App\Modules\Campaigns\Requests\CampaignTableRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class CampaignTableService
{
    private $campaignTableModel;

    public function __construct(CampaignTable $campaignTableModel)
    {
        $this->campaignTableModel = $campaignTableModel;
    }

    public function getById(Int $id): CampaignTable
    {
        return $this->campaignTableModel->findOrFail($id);
    }

    public function paginate(Request $request, Int $limit = 10, Int $campaign_id): LengthAwarePaginator
    {
        if ($request->has('search')) {
            $search = $request->input('search');
            return $this->campaignTableModel->where('campaign_id', $campaign_id)->where('unit', 'like', '%' . $search . '%')
            ->orWhere('type', 'like', '%' . $search . '%')->orderBy('id', 'DESC')->paginate($limit);
        }
        return $this->campaignTableModel->where('campaign_id', $campaign_id)->orderBy('id', 'DESC')->paginate($limit);
    }

    public function create(CampaignTableRequest $request, Int $campaign_id): void
    {
        $this->campaignTableModel->create([
            ...$request->all(),
            'campaign_id' => $campaign_id
        ]);
    }

    public function update(CampaignTableRequest $request, CampaignTable $data) : void
    {
        $data->update([
            ...$request->all(),
        ]);
    }

    public function delete(CampaignTable $data): void
    {
        $data->delete();
    }

}
