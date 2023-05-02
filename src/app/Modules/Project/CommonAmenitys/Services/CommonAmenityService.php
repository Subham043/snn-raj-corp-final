<?php

namespace App\Modules\Project\CommonAmenitys\Services;

use App\Http\Services\FileService;
use App\Modules\Project\CommonAmenitys\Models\CommonAmenity;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;

class CommonAmenityService
{

    public function all(): Collection
    {
        return CommonAmenity::all();
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = CommonAmenity::latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): CommonAmenity|null
    {
        return CommonAmenity::findOrFail($id);
    }

    public function create(array $data): CommonAmenity
    {
        $amenity = CommonAmenity::create($data);
        $amenity->user_id = auth()->user()->id;
        $amenity->save();
        return $amenity;
    }

    public function update(array $data, CommonAmenity $amenity): CommonAmenity
    {
        $amenity->update($data);
        return $amenity;
    }

    public function saveImage(CommonAmenity $amenity): CommonAmenity
    {
        $this->deleteImage($amenity);
        $image = (new FileService)->save_file('image', (new CommonAmenity)->image_path);
        return $this->update([
            'image' => $image,
        ], $amenity);
    }

    public function delete(CommonAmenity $amenity): bool|null
    {
        $this->deleteImage($amenity);
        return $amenity->delete();
    }

    public function deleteImage(CommonAmenity $amenity): void
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
