<?php

namespace App\Modules\Enquiry\FreeAdForm\Services;

use App\Modules\Enquiry\FreeAdForm\Models\FreeAdForm;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;

class FreeAdFormService
{

    public function all(): Collection
    {
        return FreeAdForm::all();
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = FreeAdForm::latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): FreeAdForm|null
    {
        return FreeAdForm::findOrFail($id);
    }

    public function create(array $data): FreeAdForm
    {
        return FreeAdForm::create($data);
    }

    public function update(array $data, FreeAdForm $freeAdForm): FreeAdForm
    {
        $freeAdForm->update($data);
        return $freeAdForm;
    }

    public function delete(FreeAdForm $user): bool|null
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
