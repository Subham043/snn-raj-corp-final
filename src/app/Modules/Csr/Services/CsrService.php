<?php

namespace App\Modules\Csr\Services;

use App\Http\Services\FileService;
use App\Modules\Csr\Models\Csr;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;

class CsrService
{

    public function all(): Collection
    {
        return Csr::all();
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = Csr::latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): Csr
    {
        return Csr::findOrFail($id);
    }

    public function create(array $data): Csr
    {
        $csr = Csr::create($data);
        $csr->user_id = auth()->user()->id;
        $csr->save();
        return $csr;
    }

    public function update(array $data, Csr $csr): Csr
    {
        $csr->update($data);
        return $csr;
    }

    public function saveImage(Csr $csr): Csr
    {
        $this->deleteImage($csr);
        $image = (new FileService)->save_file('image', (new Csr)->image_path);
        return $this->update([
            'image' => $image,
        ], $csr);
    }

    public function delete(Csr $csr): bool|null
    {
        $this->deleteImage($csr);
        return $csr->delete();
    }

    public function deleteImage(Csr $csr): void
    {
        if($csr->image){
            $path = str_replace("storage","app/public",$csr->image);
            (new FileService)->delete_file($path);
        }
    }

}

class CommonFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('heading', 'LIKE', '%' . $value . '%')
        ->orWhere('image_title', 'LIKE', '%' . $value . '%')
        ->orWhere('image_alt', 'LIKE', '%' . $value . '%')
        ->orWhere('description_unfiltered', 'LIKE', '%' . $value . '%');
    }
}
