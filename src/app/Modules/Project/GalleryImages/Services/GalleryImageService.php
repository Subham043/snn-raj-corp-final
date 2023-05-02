<?php

namespace App\Modules\Project\GalleryImages\Services;

use App\Http\Services\FileService;
use App\Modules\Project\GalleryImages\Models\GalleryImage;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;

class GalleryImageService
{

    public function all(): Collection
    {
        return GalleryImage::all();
    }

    public function paginate(Int $total = 10, Int $project_id): LengthAwarePaginator
    {
        $query = GalleryImage::where('project_id', $project_id)->latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): GalleryImage|null
    {
        return GalleryImage::findOrFail($id);
    }

    public function getByIdAndProjectId(Int $id, Int $project_id): GalleryImage
    {
        return GalleryImage::where('id', $id)->where('project_id', $project_id)->firstOrFail();
    }

    public function create(array $data, Int $project_id): GalleryImage
    {
        $gallery_image = GalleryImage::create($data);
        $gallery_image->user_id = auth()->user()->id;
        $gallery_image->project_id = $project_id;
        $gallery_image->save();
        return $gallery_image;
    }

    public function update(array $data, GalleryImage $gallery_image): GalleryImage
    {
        $gallery_image->update($data);
        return $gallery_image;
    }

    public function saveImage(GalleryImage $gallery_image): GalleryImage
    {
        $this->deleteImage($gallery_image);
        $image = (new FileService)->save_file('image', (new GalleryImage)->image_path);
        return $this->update([
            'image' => $image,
        ], $gallery_image);
    }

    public function delete(GalleryImage $gallery_image): bool|null
    {
        $this->deleteImage($gallery_image);
        return $gallery_image->delete();
    }

    public function deleteImage(GalleryImage $gallery_image): void
    {
        if($gallery_image->image){
            $path = str_replace("storage","app/public",$gallery_image->image);
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
