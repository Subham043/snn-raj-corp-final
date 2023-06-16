<?php

namespace App\Modules\Enquiry\CareerForm\Services;

use App\Http\Services\FileService;
use App\Modules\Enquiry\CareerForm\Models\CareerForm;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;

class CareerFormService
{

    public function all(): Collection
    {
        return CareerForm::all();
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = CareerForm::latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): CareerForm|null
    {
        return CareerForm::findOrFail($id);
    }

    public function create(array $data): CareerForm
    {
        return CareerForm::create($data);
    }

    public function update(array $data, CareerForm $careerForm): CareerForm
    {
        $careerForm->update($data);
        return $careerForm;
    }

    public function saveCv(CareerForm $careerForm): CareerForm
    {
        $careerForm_cv = (new FileService)->save_file('cv', (new CareerForm)->cv_path);
        return $this->update([
            'cv' => $careerForm_cv,
        ], $careerForm);
    }

    public function delete(CareerForm $user): bool|null
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
        ->orWhere('experience', 'LIKE', '%' . $value . '%')
        ->orWhere('description', 'LIKE', '%' . $value . '%')
        ->orWhere('email', 'LIKE', '%' . $value . '%');
    }
}
