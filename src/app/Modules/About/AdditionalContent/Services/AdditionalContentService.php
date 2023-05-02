<?php

namespace App\Modules\About\AdditionalContent\Services;

use App\Http\Services\FileService;
use App\Modules\About\AdditionalContent\Models\AdditionalContent;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Spatie\QueryBuilder\AllowedFilter;

class AdditionalContentService
{

    public function all(): Collection
    {
        return AdditionalContent::all();
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = AdditionalContent::latest();
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

    public function create(array $data): AdditionalContent
    {
        $addition_content = AdditionalContent::create($data);
        $addition_content->user_id = auth()->user()->id;
        $addition_content->save();
        return $addition_content;
    }

    public function update(array $data, AdditionalContent $addition_content): AdditionalContent
    {
        $addition_content->update($data);
        return $addition_content;
    }

    public function saveImage(AdditionalContent $addition_content): AdditionalContent
    {
        $this->deleteImage($addition_content);
        $image = (new FileService)->save_file('image', (new AdditionalContent)->image_path);
        return $this->update([
            'image' => $image,
        ], $addition_content);
    }

    public function delete(AdditionalContent $addition_content): bool|null
    {
        $this->deleteImage($addition_content);
        return $addition_content->delete();
    }

    public function deleteImage(AdditionalContent $addition_content): void
    {
        if($addition_content->image){
            $path = str_replace("storage","app/public",$addition_content->image);
            (new FileService)->delete_file($path);
        }
    }

    public function main_all(): Collection
    {
        return Cache::remember('about_page_additional_main', 60*60*24, function(){
            return AdditionalContent::where('is_draft', true)->latest()->get();
        });
    }

}

class CommonFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('heading', 'LIKE', '%' . $value . '%')
        ->orWhere('button_text', 'LIKE', '%' . $value . '%')
        ->orWhere('button_link', 'LIKE', '%' . $value . '%')
        ->orWhere('description_unfiltered', 'LIKE', '%' . $value . '%');
    }
}
