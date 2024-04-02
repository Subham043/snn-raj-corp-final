<?php

namespace App\Modules\Enquiry\EmpanelmentForm\Services;

use App\Http\Services\FileService;
use App\Modules\Enquiry\EmpanelmentForm\Models\EmpanelmentForm;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;

class EmpanelmentFormService
{

    public function all(): Collection
    {
        return EmpanelmentForm::all();
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = EmpanelmentForm::latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): EmpanelmentForm|null
    {
        return EmpanelmentForm::findOrFail($id);
    }

    public function create(array $data): EmpanelmentForm
    {
        return EmpanelmentForm::create($data);
    }

    public function update(array $data, EmpanelmentForm $empanelmentForm): EmpanelmentForm
    {
        $empanelmentForm->update($data);
        return $empanelmentForm;
    }

    public function saveFile(EmpanelmentForm $empanelmentForm, String $file_key): EmpanelmentForm
    {
        $empanelmentForm_cv = (new FileService)->save_file($file_key, (new EmpanelmentForm)->file_path);
        return $this->update([
            $file_key => $empanelmentForm_cv,
        ], $empanelmentForm);
    }

    public function delete(EmpanelmentForm $user): bool|null
    {
        return $user->delete();
    }

    public function getByPhone(string $phone): EmpanelmentForm|null
    {
        return EmpanelmentForm::where('phone',$phone)->firstOrFail();
    }

}

class CommonFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('scope', 'LIKE', '%' . $value . '%')
        ->orWhere('channel_partner', 'LIKE', '%' . $value . '%')
        ->orWhere('phone', 'LIKE', '%' . $value . '%')
        ->orWhere('telephone', 'LIKE', '%' . $value . '%')
        ->orWhere('email', 'LIKE', '%' . $value . '%')
        ->orWhere('rera', 'LIKE', '%' . $value . '%')
        ->orWhere('contact_person_name', 'LIKE', '%' . $value . '%')
        ->orWhere('designation', 'LIKE', '%' . $value . '%')
        ->orWhere('pan', 'LIKE', '%' . $value . '%')
        ->orWhere('gst', 'LIKE', '%' . $value . '%')
        ->orWhere('sac', 'LIKE', '%' . $value . '%')
        ->orWhere('tax', 'LIKE', '%' . $value . '%')
        ->orWhere('bank_name', 'LIKE', '%' . $value . '%')
        ->orWhere('bank_address', 'LIKE', '%' . $value . '%')
        ->orWhere('bank_branch', 'LIKE', '%' . $value . '%')
        ->orWhere('bank_account_number', 'LIKE', '%' . $value . '%')
        ->orWhere('ifsc', 'LIKE', '%' . $value . '%')
        ->orWhere('address', 'LIKE', '%' . $value . '%')
        ->orWhere('company_type', 'LIKE', '%' . $value . '%')
        ->orWhere('msme', 'LIKE', '%' . $value . '%')
        ->orWhere('esi', 'LIKE', '%' . $value . '%')
        ->orWhere('epf', 'LIKE', '%' . $value . '%');
    }
}