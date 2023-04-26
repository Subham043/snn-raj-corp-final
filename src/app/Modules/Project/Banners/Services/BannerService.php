<?php

namespace App\Modules\Project\Banners\Services;

use App\Http\Services\FileService;
use App\Modules\Project\Banners\Models\Banner;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;

class BannerService
{

    public function all(): Collection
    {
        return Banner::all();
    }

    public function paginate(Int $total = 10, Int $project_id): LengthAwarePaginator
    {
        $query = Banner::where('project_id', $project_id)->latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): Banner
    {
        return Banner::findOrFail($id);
    }

    public function getByIdAndProjectId(Int $id, Int $project_id): Banner
    {
        return Banner::where('id', $id)->where('project_id', $project_id)->firstOrFail();
    }

    public function create(array $data, Int $project_id): Banner
    {
        $banner = Banner::create($data);
        $banner->user_id = auth()->user()->id;
        $banner->project_id = $project_id;
        $banner->save();
        return $banner;
    }

    public function update(array $data, Banner $banner): Banner
    {
        $banner->update($data);
        return $banner;
    }

    public function saveImage(Banner $banner): Banner
    {
        $this->deleteImage($banner);
        $image = (new FileService)->save_file('image', (new Banner)->image_path);
        return $this->update([
            'image' => $image,
        ], $banner);
    }

    public function delete(Banner $banner): bool|null
    {
        $this->deleteImage($banner);
        return $banner->delete();
    }

    public function deleteImage(Banner $banner): void
    {
        if($banner->image){
            $path = str_replace("storage","app/public",$banner->image);
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
