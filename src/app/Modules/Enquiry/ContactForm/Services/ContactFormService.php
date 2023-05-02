<?php

namespace App\Modules\Enquiry\ContactForm\Services;

use App\Modules\Enquiry\ContactForm\Models\ContactForm;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;

class ContactFormService
{

    public function all(): Collection
    {
        return ContactForm::all();
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = ContactForm::latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): ContactForm|null
    {
        return ContactForm::findOrFail($id);
    }

    public function create(array $data): ContactForm
    {
        return ContactForm::create($data);
    }

    public function delete(ContactForm $user): bool|null
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
        ->orWhere('message', 'LIKE', '%' . $value . '%')
        ->orWhere('email', 'LIKE', '%' . $value . '%');
    }
}
