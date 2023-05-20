<?php

namespace App\Modules\Enquiry\ReferalForm\Services;

use App\Modules\Enquiry\ReferalForm\Models\ReferalForm;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;

class ReferalFormService
{

    public function all(): Collection
    {
        return ReferalForm::with(['member_project', 'referal_project'])->all();
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = ReferalForm::with(['member_project', 'referal_project'])->latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): ReferalForm|null
    {
        return ReferalForm::with(['member_project', 'referal_project'])->findOrFail($id);
    }

    public function create(array $data): ReferalForm
    {
        return ReferalForm::create($data);
    }

    public function delete(ReferalForm $user): bool|null
    {
        return $user->delete();
    }

}

class CommonFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('member_name', 'LIKE', '%' . $value . '%')
        ->orWhere('member_phone', 'LIKE', '%' . $value . '%')
        ->orWhere('member_email', 'LIKE', '%' . $value . '%')
        ->orWhere('member_unit', 'LIKE', '%' . $value . '%')
        ->orWhere('referal_name', 'LIKE', '%' . $value . '%')
        ->orWhere('referal_phone', 'LIKE', '%' . $value . '%')
        ->orWhere('referal_email', 'LIKE', '%' . $value . '%')
        ->orWhere('referal_relation', 'LIKE', '%' . $value . '%');
    }
}
