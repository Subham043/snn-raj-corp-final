<?php

namespace App\Modules\Project\Projects\Services;

use App\Http\Services\FileService;
use App\Modules\Project\Projects\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;

class ProjectService
{

    public function all(): Collection
    {
        return Project::all();
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = Project::latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): Project
    {
        return Project::findOrFail($id);
    }

    public function create(array $data): Project
    {
        $project = Project::create($data);
        $project->user_id = auth()->user()->id;
        $project->save();
        return $project;
    }

    public function update(array $data, Project $project): Project
    {
        $project->update($data);
        return $project;
    }

    public function saveBrochure(Project $project): Project
    {
        $this->deleteBrochure($project);
        $brochure = (new FileService)->save_file('brochure', (new Project)->brochure_path);
        return $this->update([
            'brochure' => $brochure,
        ], $project);
    }

    public function delete(Project $project): bool|null
    {
        $this->deleteBrochure($project);
        return $project->delete();
    }

    public function deleteBrochure(Project $project): void
    {
        if($project->brochure){
            $path = str_replace("storage","app/public",$project->brochure);
            (new FileService)->delete_file($path);
        }
    }

    public function main_paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = Project::where('is_draft', true)->latest();
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
        $query->where('name', 'LIKE', '%' . $value . '%')
        ->orWhere('slug', 'LIKE', '%' . $value . '%')
        ->orWhere('location', 'LIKE', '%' . $value . '%')
        ->orWhere('address', 'LIKE', '%' . $value . '%')
        ->orWhere('floor', 'LIKE', '%' . $value . '%')
        ->orWhere('acre', 'LIKE', '%' . $value . '%')
        ->orWhere('tower', 'LIKE', '%' . $value . '%')
        ->orWhere('rera', 'LIKE', '%' . $value . '%')
        ->orWhere('brief_description', 'LIKE', '%' . $value . '%')
        ->orWhere('description_unfiltered', 'LIKE', '%' . $value . '%');
    }
}
