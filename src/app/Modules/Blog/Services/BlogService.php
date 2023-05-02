<?php

namespace App\Modules\Blog\Services;

use App\Http\Services\FileService;
use App\Modules\Blog\Models\Blog;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Spatie\QueryBuilder\AllowedFilter;

class BlogService
{

    public function all(): Collection
    {
        return Blog::all();
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = Blog::latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): Blog|null
    {
        return Blog::findOrFail($id);
    }

    public function create(array $data): Blog
    {
        $blog = Blog::create($data);
        $blog->user_id = auth()->user()->id;
        $blog->save();
        return $blog;
    }

    public function update(array $data, Blog $blog): Blog
    {
        $blog->update($data);
        return $blog;
    }

    public function saveImage(Blog $blog): Blog
    {
        $this->deleteImage($blog);
        $image = (new FileService)->save_file('image', (new Blog)->image_path);
        return $this->update([
            'image' => $image,
        ], $blog);
    }

    public function delete(Blog $blog): bool|null
    {
        $this->deleteImage($blog);
        return $blog->delete();
    }

    public function deleteImage(Blog $blog): void
    {
        if($blog->image){
            $path = str_replace("storage","app/public",$blog->image);
            (new FileService)->delete_file($path);
        }
    }

    public function clear_cache(Blog $blog): void
    {
        Cache::forget('all_blog_main');
        Cache::forget('blog_'.$blog->slug);
    }

    public function main_all()
    {
        return Cache::remember('all_blog_main', 60*60*24, function(){
            return Blog::where('is_draft', true)->limit(3)->latest()
            ->get();
        });
    }

    public function main_paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = Blog::where('is_draft', true)
                    ->latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getBySlugMain(String $slug): Blog|null
    {
        return Cache::remember('blog_'.$slug, 60*60*24, function() use($slug){
            return Blog::where('slug', $slug)
            ->where('is_draft', true)
            ->firstOrFail();
        });
    }

    public function getPrev(Int $id): Blog|null
    {
        return Blog::select('name','slug')->where('id', '<', $id)
        ->where('is_draft', true)
        ->orderBy('id','desc')
        ->first();
    }

    public function getNext(Int $id): Blog|null
    {
        return Blog::select('name','slug')->where('id', '>', $id)
        ->where('is_draft', true)
        ->orderBy('id','desc')
        ->first();
    }

}

class CommonFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('name', 'LIKE', '%' . $value . '%')
        ->orWhere('slug', 'LIKE', '%' . $value . '%')
        ->orWhere('heading', 'LIKE', '%' . $value . '%')
        ->orWhere('description_unfiltered', 'LIKE', '%' . $value . '%');
    }
}
