<?php

namespace App\Modules\Project\Amenitys\Services;

use App\Http\Services\FileService;
use App\Modules\Project\Amenitys\Models\Amenity;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;

class AmenityService
{

    public function all(): Collection
    {
        return Amenity::all();
    }

    public function paginate(Int $total = 10, Int $project_id): LengthAwarePaginator
    {
        $query = Amenity::where('project_id', $project_id)->latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): Amenity
    {
        return Amenity::findOrFail($id);
    }

    public function getByIdAndProjectId(Int $id, Int $project_id): Amenity
    {
        return Amenity::where('id', $id)->where('project_id', $project_id)->firstOrFail();
    }

    public function create(array $data, Int $project_id): Amenity
    {
        $amenity = Amenity::create($data);
        $amenity->user_id = auth()->user()->id;
        $amenity->project_id = $project_id;
        $amenity->save();
        return $amenity;
    }

    public function update(array $data, Amenity $amenity): Amenity
    {
        $amenity->update($data);
        return $amenity;
    }

    public function saveImage(Amenity $amenity): Amenity
    {
        $this->deleteImage($amenity);
        $image = (new FileService)->save_file('image', (new Amenity)->image_path);
        return $this->update([
            'image' => $image,
        ], $amenity);
    }

    public function delete(Amenity $amenity): bool|null
    {
        $this->deleteImage($amenity);
        return $amenity->delete();
    }

    public function deleteImage(Amenity $amenity): void
    {
        if($amenity->image){
            $path = str_replace("storage","app/public",$amenity->image);
            (new FileService)->delete_file($path);
        }
    }

}

class CommonFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('image_title', 'LIKE', '%' . $value . '%')
        ->orWhere('image_alt', 'LIKE', '%' . $value . '%');
    }
}
