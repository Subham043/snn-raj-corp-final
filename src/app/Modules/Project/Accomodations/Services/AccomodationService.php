<?php

namespace App\Modules\Project\Accomodations\Services;

use App\Modules\Project\Accomodations\Models\Accomodation;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;

class AccomodationService
{

    public function all(): Collection
    {
        return Accomodation::all();
    }

    public function paginate(Int $total = 10, Int $project_id): LengthAwarePaginator
    {
        $query = Accomodation::where('project_id', $project_id)->latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): Accomodation|null
    {
        return Accomodation::findOrFail($id);
    }

    public function getByIdAndProjectId(Int $id, Int $project_id): Accomodation
    {
        return Accomodation::where('id', $id)->where('project_id', $project_id)->firstOrFail();
    }

    public function create(array $data, Int $project_id): Accomodation
    {
        $accomodation = Accomodation::create($data);
        $accomodation->user_id = auth()->user()->id;
        $accomodation->project_id = $project_id;
        $accomodation->save();
        return $accomodation;
    }

    public function update(array $data, Accomodation $accomodation): Accomodation
    {
        $accomodation->update($data);
        return $accomodation;
    }

    public function delete(Accomodation $accomodation): bool|null
    {
        return $accomodation->delete();
    }

}

class CommonFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('room', 'LIKE', '%' . $value . '%')
        ->orWhere('area', 'LIKE', '%' . $value . '%');
    }
}
