<?php

namespace App\Modules\Legal\Services;

use App\Modules\Legal\Models\Legal;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;

class LegalService
{

    public function all(): Collection
    {
        return Legal::all();
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = Legal::latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): Legal
    {
        return Legal::findOrFail($id);
    }

    public function create(array $data): Legal
    {
        $legal = Legal::create($data);
        $legal->user_id = auth()->user()->id;
        $legal->save();
        return $legal;
    }

    public function update(array $data, Legal $legal): Legal
    {
        $legal->update($data);
        return $legal;
    }

    public function delete(Legal $legal): bool|null
    {
        return $legal->delete();
    }

}

class CommonFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('heading', 'LIKE', '%' . $value . '%')
        ->orWhere('page_name', 'LIKE', '%' . $value . '%')
        ->orWhere('slug', 'LIKE', '%' . $value . '%')
        ->orWhere('description_unfiltered', 'LIKE', '%' . $value . '%');
    }
}
