<?php

namespace App\Modules\Enquiry\ProjectCampaignForm\Services;

use App\Modules\Enquiry\ProjectCampaignForm\Models\ProjectCampaignForm;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;

class ProjectCampaignFormService
{

    public function all(): Collection
    {
        return ProjectCampaignForm::all();
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = ProjectCampaignForm::latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): ProjectCampaignForm|null
    {
        return ProjectCampaignForm::findOrFail($id);
    }

    public function create(array $data): ProjectCampaignForm
    {
        return ProjectCampaignForm::create($data);
    }

    public function update(array $data, ProjectCampaignForm $campaignForm): ProjectCampaignForm
    {
        $campaignForm->update($data);
        return $campaignForm;
    }

    public function delete(ProjectCampaignForm $user): bool|null
    {
        return $user->delete();
    }

}

class CommonFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('name', 'LIKE', '%' . $value . '%')
        ->orWhere('page_url', 'LIKE', '%' . $value . '%')
        ->orWhere('phone', 'LIKE', '%' . $value . '%')
        ->orWhere('email', 'LIKE', '%' . $value . '%');
    }
}
