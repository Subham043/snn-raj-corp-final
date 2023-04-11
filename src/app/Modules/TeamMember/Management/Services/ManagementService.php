<?php

namespace App\Modules\TeamMember\Management\Services;

use App\Http\Services\FileService;
use App\Modules\TeamMember\Management\Models\Management;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;

class ManagementService
{

    public function all(): Collection
    {
        return Management::all();
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = Management::latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): Management
    {
        return Management::findOrFail($id);
    }

    public function create(array $data): Management
    {
        $management = Management::create($data);
        $management->user_id = auth()->user()->id;
        $management->save();
        return $management;
    }

    public function update(array $data, Management $management): Management
    {
        $management->update($data);
        return $management;
    }

    public function saveImage(Management $management): Management
    {
        $this->deleteImage($management);
        $image = (new FileService)->save_file('image', (new Management)->image_path);
        return $this->update([
            'image' => $image,
        ], $management);
    }

    public function delete(Management $management): bool|null
    {
        $this->deleteImage($management);
        return $management->delete();
    }

    public function deleteImage(Management $management): void
    {
        if($management->image){
            $path = str_replace("storage","app/public",$management->image);
            (new FileService)->delete_file($path);
        }
    }

}

class CommonFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('name', 'LIKE', '%' . $value . '%')
        ->orWhere('designation', 'LIKE', '%' . $value . '%')
        ->orWhere('description_unfiltered', 'LIKE', '%' . $value . '%');
    }
}
