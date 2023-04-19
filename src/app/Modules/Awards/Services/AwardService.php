<?php

namespace App\Modules\Awards\Services;

use App\Http\Services\FileService;
use App\Modules\Awards\Models\Award;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;

class AwardService
{

    public function all(): Collection
    {
        return Award::all();
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = Award::latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): Award
    {
        return Award::findOrFail($id);
    }

    public function create(array $data): Award
    {
        $award = Award::create($data);
        $award->user_id = auth()->user()->id;
        $award->save();
        return $award;
    }

    public function update(array $data, Award $award): Award
    {
        $award->update($data);
        return $award;
    }

    public function saveImage(Award $award): Award
    {
        $this->deleteImage($award);
        $image = (new FileService)->save_file('image', (new Award)->image_path);
        return $this->update([
            'image' => $image,
        ], $award);
    }

    public function delete(Award $award): bool|null
    {
        $this->deleteImage($award);
        return $award->delete();
    }

    public function deleteImage(Award $award): void
    {
        if($award->image){
            $path = str_replace("storage","app/public",$award->image);
            (new FileService)->delete_file($path);
        }
    }

    public function main_paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = Award::where('is_draft', true)->orderBy('year', 'DESC');
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

}

class CommonFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('title', 'LIKE', '%' . $value . '%')
        ->orWhere('sub_title', 'LIKE', '%' . $value . '%')
        ->orWhere('year', 'LIKE', '%' . $value . '%')
        ->orWhere('description', 'LIKE', '%' . $value . '%');
    }
}
