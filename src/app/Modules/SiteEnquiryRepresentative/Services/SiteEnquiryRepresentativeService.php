<?php

namespace App\Modules\SiteEnquiryRepresentative\Services;

use App\Modules\SiteEnquiryRepresentative\Models\SiteEnquiryRepresentative;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;

class SiteEnquiryRepresentativeService
{

    public function all(): Collection
    {
        return SiteEnquiryRepresentative::all();
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = SiteEnquiryRepresentative::latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): SiteEnquiryRepresentative|null
    {
        return SiteEnquiryRepresentative::findOrFail($id);
    }

    public function create(array $data): SiteEnquiryRepresentative
    {
        return SiteEnquiryRepresentative::create($data);
    }

    public function update(array $data, SiteEnquiryRepresentative $siteEnquiryRep): SiteEnquiryRepresentative
    {
        $siteEnquiryRep->update($data);
        return $siteEnquiryRep;
    }

    public function delete(SiteEnquiryRepresentative $siteEnquiryRep): bool|null
    {
        return $siteEnquiryRep->delete();
    }

}

class CommonFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('name', 'LIKE', '%' . $value . '%')
        ->orWhere('paramantra_code', 'LIKE', '%' . $value . '%');
    }
}