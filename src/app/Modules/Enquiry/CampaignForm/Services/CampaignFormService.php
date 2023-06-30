<?php

namespace App\Modules\Enquiry\CampaignForm\Services;

use App\Modules\Enquiry\CampaignForm\Models\CampaignForm;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;

class CampaignFormService
{

    public function all(): Collection
    {
        return CampaignForm::all();
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = CampaignForm::latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): CampaignForm|null
    {
        return CampaignForm::findOrFail($id);
    }

    public function create(array $data): CampaignForm
    {
        return CampaignForm::create($data);
    }

    public function update(array $data, CampaignForm $campaignForm): CampaignForm
    {
        $campaignForm->update($data);
        return $campaignForm;
    }

    public function delete(CampaignForm $user): bool|null
    {
        return $user->delete();
    }

}

class CommonFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('name', 'LIKE', '%' . $value . '%')
        ->orWhere('phone', 'LIKE', '%' . $value . '%')
        ->orWhere('source', 'LIKE', '%' . $value . '%')
        ->orWhere('campaign', 'LIKE', '%' . $value . '%')
        ->orWhere('email', 'LIKE', '%' . $value . '%');
    }
}
