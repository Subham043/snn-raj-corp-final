<?php

namespace App\Modules\SiteEnquiryExecutive\Services;

use App\Modules\SiteEnquiryExecutive\Models\SiteEnquiryExecutive;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;

class SiteEnquiryExecutiveService
{

    public function all(): Collection
    {
        return SiteEnquiryExecutive::all();
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = SiteEnquiryExecutive::latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): SiteEnquiryExecutive|null
    {
        return SiteEnquiryExecutive::findOrFail($id);
    }

    public function getByEmail(String $email): SiteEnquiryExecutive
    {
        return SiteEnquiryExecutive::where('email', $email)->firstOrFail();
    }

    public function create(array $data): SiteEnquiryExecutive
    {
        return SiteEnquiryExecutive::create($data);
    }

    public function update(array $data, SiteEnquiryExecutive $user): SiteEnquiryExecutive
    {
        $user->update($data);
        return $user;
    }

    public function delete(SiteEnquiryExecutive $user): bool|null
    {
        return $user->delete();
    }

}

class CommonFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('name', 'LIKE', '%' . $value . '%')
        ->orWhere('email', 'LIKE', '%' . $value . '%');
    }
}