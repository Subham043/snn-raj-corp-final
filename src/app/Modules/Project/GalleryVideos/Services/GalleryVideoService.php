<?php

namespace App\Modules\Project\GalleryVideos\Services;

use App\Modules\Project\GalleryVideos\Models\GalleryVideo;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;

class GalleryVideoService
{

    public function all(): Collection
    {
        return GalleryVideo::all();
    }

    public function paginate(Int $total = 10, Int $project_id): LengthAwarePaginator
    {
        $query = GalleryVideo::where('project_id', $project_id)->latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): GalleryVideo
    {
        return GalleryVideo::findOrFail($id);
    }

    public function getByIdAndProjectId(Int $id, Int $project_id): GalleryVideo
    {
        return GalleryVideo::where('id', $id)->where('project_id', $project_id)->firstOrFail();
    }

    public function create(array $data, Int $project_id): GalleryVideo
    {
        $gallery_video = GalleryVideo::create($data);
        $gallery_video->user_id = auth()->user()->id;
        $gallery_video->project_id = $project_id;
        $gallery_video->save();
        return $gallery_video;
    }

    public function update(array $data, GalleryVideo $gallery_video): GalleryVideo
    {
        $gallery_video->update($data);
        return $gallery_video;
    }

    public function delete(GalleryVideo $gallery_video): bool|null
    {
        return $gallery_video->delete();
    }

}

class CommonFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('video_title', 'LIKE', '%' . $value . '%');
    }
}
