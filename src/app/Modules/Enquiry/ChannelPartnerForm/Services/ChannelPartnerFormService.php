<?php

namespace App\Modules\Enquiry\ChannelPartnerForm\Services;

use App\Modules\Enquiry\ChannelPartnerForm\Models\ChannelPartnerForm;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;

class ChannelPartnerFormService
{

    public function all(): Collection
    {
        return ChannelPartnerForm::all();
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = ChannelPartnerForm::latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): ChannelPartnerForm|null
    {
        return ChannelPartnerForm::findOrFail($id);
    }

    public function create(array $data): ChannelPartnerForm
    {
        return ChannelPartnerForm::create($data);
    }

    public function update(array $data, ChannelPartnerForm $freeAdForm): ChannelPartnerForm
    {
        $freeAdForm->update($data);
        return $freeAdForm;
    }

    public function delete(ChannelPartnerForm $user): bool|null
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
        ->orWhere('project', 'LIKE', '%' . $value . '%')
        ->orWhere('source', 'LIKE', '%' . $value . '%')
        ->orWhere('executive', 'LIKE', '%' . $value . '%')
        ->orWhere('email', 'LIKE', '%' . $value . '%');
    }
}