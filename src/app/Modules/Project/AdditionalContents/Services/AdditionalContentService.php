<?php

namespace App\Modules\Project\AdditionalContents\Services;

use App\Http\Services\FileService;
use App\Modules\Project\AdditionalContents\Models\AdditionalContent;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;

class AdditionalContentService
{

    public function all(): Collection
    {
        return AdditionalContent::all();
    }

    public function paginate(Int $total = 10, Int $project_id): LengthAwarePaginator
    {
        $query = AdditionalContent::where('project_id', $project_id)->latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): AdditionalContent|null
    {
        return AdditionalContent::findOrFail($id);
    }

    public function getByIdAndProjectId(Int $id, Int $project_id): AdditionalContent
    {
        return AdditionalContent::where('id', $id)->where('project_id', $project_id)->firstOrFail();
    }

    public function create(array $data, Int $project_id): AdditionalContent
    {
        $content = AdditionalContent::create($data);
        $content->user_id = auth()->user()->id;
        $content->project_id = $project_id;
        $content->save();
        return $content;
    }

    public function update(array $data, AdditionalContent $content): AdditionalContent
    {
        $content->update($data);
        return $content;
    }

    public function saveImage(AdditionalContent $content): AdditionalContent
    {
        $this->deleteImage($content);
        $image = (new FileService)->save_file('image', (new AdditionalContent)->image_path);
        return $this->update([
            'image' => $image,
        ], $content);
    }

    public function delete(AdditionalContent $content): bool|null
    {
        $this->deleteImage($content);
        return $content->delete();
    }

    public function deleteImage(AdditionalContent $content): void
    {
        if($content->image){
            $path = str_replace("storage","app/public",$content->image);
            (new FileService)->delete_file($path);
        }
    }

}

class CommonFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('heading', 'LIKE', '%' . $value . '%')
        ->orWhere('description_unfiltered', 'LIKE', '%' . $value . '%');
    }
}
