<?php

namespace App\Modules\Enquiry\PopupForm\Services;

use App\Modules\Enquiry\PopupForm\Models\PopupForm;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;

class PopupFormService
{

    public function all(): Collection
    {
        return PopupForm::all();
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = PopupForm::where('is_verified', true)->latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): PopupForm|null
    {
        return PopupForm::findOrFail($id);
    }

    public function create(array $data): PopupForm
    {
        return PopupForm::create($data);
    }

    public function update(array $data, PopupForm $contactForm): PopupForm
    {
        $contactForm->update($data);
        return $contactForm;
    }

    public function delete(PopupForm $user): bool|null
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
        ->orWhere('message', 'LIKE', '%' . $value . '%')
        ->orWhere('email', 'LIKE', '%' . $value . '%');
    }
}
