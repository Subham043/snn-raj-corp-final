<?php

namespace App\Modules\Project\Plans\Services;

use App\Http\Services\FileService;
use App\Modules\Project\Plans\Models\Plan;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;

class PlanService
{

    public function all(): Collection
    {
        return Plan::all();
    }

    public function paginate(Int $total = 10, Int $project_id): LengthAwarePaginator
    {
        $query = Plan::where('project_id', $project_id)->latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): Plan
    {
        return Plan::findOrFail($id);
    }

    public function getByIdAndProjectId(Int $id, Int $project_id): Plan
    {
        return Plan::where('id', $id)->where('project_id', $project_id)->firstOrFail();
    }

    public function create(array $data, Int $project_id): Plan
    {
        $plan = Plan::create($data);
        $plan->user_id = auth()->user()->id;
        $plan->project_id = $project_id;
        $plan->save();
        return $plan;
    }

    public function update(array $data, Plan $plan): Plan
    {
        $plan->update($data);
        return $plan;
    }

    public function saveImage(Plan $plan): Plan
    {
        $this->deleteImage($plan);
        $image = (new FileService)->save_file('image', (new Plan)->image_path);
        return $this->update([
            'image' => $image,
        ], $plan);
    }

    public function delete(Plan $plan): bool|null
    {
        $this->deleteImage($plan);
        return $plan->delete();
    }

    public function deleteImage(Plan $plan): void
    {
        if($plan->image){
            $path = str_replace("storage","app/public",$plan->image);
            (new FileService)->delete_file($path);
        }
    }

}

class CommonFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('image_title', 'LIKE', '%' . $value . '%')
        ->orWhere('image_alt', 'LIKE', '%' . $value . '%');
    }
}
