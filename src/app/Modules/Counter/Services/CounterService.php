<?php

namespace App\Modules\Counter\Services;

use App\Modules\Counter\Models\Counter;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Spatie\QueryBuilder\AllowedFilter;

class CounterService
{

    public function all(): Collection
    {
        return Counter::all();
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = Counter::latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): Counter|null
    {
        return Counter::findOrFail($id);
    }

    public function create(array $data): Counter
    {
        $counter = Counter::create($data);
        $counter->user_id = auth()->user()->id;
        $counter->save();
        return $counter;
    }

    public function update(array $data, Counter $counter): Counter
    {
        $counter->update($data);
        return $counter;
    }

    public function delete(Counter $counter): bool|null
    {
        return $counter->delete();
    }

    public function main_all(): Collection
    {
        return Cache::remember('counters_main', 60*60*24, function(){
            return Counter::where('is_draft', true)->latest()->get();
        });
    }

}

class CommonFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('title', 'LIKE', '%' . $value . '%')
        ->orWhere('counter', 'LIKE', '%' . $value . '%');
    }
}
