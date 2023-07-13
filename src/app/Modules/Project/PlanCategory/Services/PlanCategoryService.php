<?php

namespace App\Modules\Project\PlanCategory\Services;

use App\Modules\Project\PlanCategory\Models\PlanCategory;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;

class PlanCategoryService
{

    public function all(): Collection
    {
        return PlanCategory::all();
    }

    public function paginate(Int $total = 10, Int $project_id): LengthAwarePaginator
    {
        $query = PlanCategory::where('project_id', $project_id)->latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): PlanCategory|null
    {
        return PlanCategory::findOrFail($id);
    }

    public function getByIdAndProjectId(Int $id, Int $project_id): PlanCategory
    {
        return PlanCategory::where('id', $id)->where('project_id', $project_id)->firstOrFail();
    }

    public function create(array $data, Int $project_id): PlanCategory
    {
        $plan = PlanCategory::create($data);
        $plan->user_id = auth()->user()->id;
        $plan->project_id = $project_id;
        $plan->save();
        return $plan;
    }

    public function update(array $data, PlanCategory $plan): PlanCategory
    {
        $plan->update($data);
        return $plan;
    }

    public function delete(PlanCategory $plan): bool|null
    {
        return $plan->delete();
    }

}

class CommonFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('title', 'LIKE', '%' . $value . '%');
    }
}
