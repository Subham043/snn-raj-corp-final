<?php

namespace App\Modules\HomePage\Testimonial\Services;

use App\Modules\HomePage\Testimonial\Models\Testimonial;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Spatie\QueryBuilder\AllowedFilter;

class TestimonialService
{

    public function all(): Collection
    {
        return Testimonial::all();
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = Testimonial::latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): Testimonial|null
    {
        return Testimonial::findOrFail($id);
    }

    public function create(array $data): Testimonial
    {
        $testimonial = Testimonial::create($data);
        $testimonial->user_id = auth()->user()->id;
        $testimonial->save();
        return $testimonial;
    }

    public function update(array $data, Testimonial $testimonial): Testimonial
    {
        $testimonial->update($data);
        return $testimonial;
    }

    public function delete(Testimonial $testimonial): bool|null
    {
        return $testimonial->delete();
    }

    public function main_all(): Collection
    {
        return Testimonial::where('is_draft', true)->latest()->get();
    }

}

class CommonFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('video', 'LIKE', '%' . $value . '%')
        ->orWhere('video_title', 'LIKE', '%' . $value . '%');
    }
}
