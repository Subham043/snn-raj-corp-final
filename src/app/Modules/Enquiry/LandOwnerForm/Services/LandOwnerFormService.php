<?php

namespace App\Modules\Enquiry\LandOwnerForm\Services;

use App\Modules\Enquiry\LandOwnerForm\Models\LandOwnerForm;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;

class LandOwnerFormService
{

    public function all(): Collection
    {
        return LandOwnerForm::all();
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = LandOwnerForm::latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): LandOwnerForm|null
    {
        return LandOwnerForm::findOrFail($id);
    }

    public function create(array $data): LandOwnerForm
    {
        return LandOwnerForm::create($data);
    }

    public function update(array $data, LandOwnerForm $contactForm): LandOwnerForm
    {
        $contactForm->update($data);
        return $contactForm;
    }

    public function delete(LandOwnerForm $user): bool|null
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
        ->orWhere('subject', 'LIKE', '%' . $value . '%')
        ->orWhere('property_location', 'LIKE', '%' . $value . '%')
        ->orWhere('email', 'LIKE', '%' . $value . '%');
    }
}
