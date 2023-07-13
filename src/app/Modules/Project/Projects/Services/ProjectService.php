<?php

namespace App\Modules\Project\Projects\Services;

use App\Http\Services\FileService;
use App\Modules\Project\Projects\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
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

    public function getById(Int $id): Project|null
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
        $project->amenity()->detach();
        return $project->delete();
    }

    public function deleteBrochure(Project $project): void
    {
        if($project->brochure){
            $path = str_replace("storage","app/public",$project->brochure);
            (new FileService)->delete_file($path);
        }
    }

    public function clear_cache(Project $project): void
    {
        Cache::forget('all_project_main');
        Cache::forget('project_'.$project->slug);
    }

    public function main_all()
    {
        return Cache::remember('all_project_main', 60*60*24, function(){
            return Project::with([
                'banner' =>  function($q) {
                    $q->where('is_draft', true);
                }
            ])
            ->withCount([
                'banner' =>  function($q) {
                    $q->where('is_draft', true);
                }
            ])
            ->where('is_draft', true)
            ->whereHas('banner', function($q) {
                $q->where('is_draft', true);
            })
            ->orderBy('is_completed', 'ASC')
            ->get();
        });
    }

    public function main_paginate(Int $total = 10, bool $status = false): LengthAwarePaginator
    {
        $query = Project::with([
                        'banner' =>  function($q) {
                            $q->where('is_draft', true);
                        }
                    ])
                    ->withCount([
                        'banner' =>  function($q) {
                            $q->where('is_draft', true);
                        }
                    ])
                    ->where('is_draft', true)
                    ->where('is_completed', $status)
                    ->whereHas('banner', function($q) {
                        $q->where('is_draft', true);
                    })
                    ->latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function main_paginate_all(bool $status): Collection
    {
                return Project::with([
                        'banner' =>  function($q) {
                            $q->where('is_draft', true);
                        }
                    ])
                    ->withCount([
                        'banner' =>  function($q) {
                            $q->where('is_draft', true);
                        }
                    ])
                    ->where('is_draft', true)
                    ->whereHas('banner', function($q) use($status) {
                        $q->where('is_draft', true);
                        $q->where('is_completed', $status);
                    })
                    ->get();
    }

    public function getBySlugMain(String $slug): Project|null
    {
        return Cache::remember('project_'.$slug, 60*60*24, function() use($slug){
            return Project::with([
                'banner' =>  function($q) {
                    $q->where('is_draft', true);
                },
                'gallery_image' =>  function($q) {
                    $q->where('is_draft', true);
                },
                'gallery_video' =>  function($q) {
                    $q->where('is_draft', true);
                },
                'plan_category' =>  function($q) {
                    $q->with('plan');
                },
                'amenity',
                'additional_content' =>  function($q) {
                    $q->where('is_draft', true);
                },
                'accomodation' =>  function($q) {
                    $q->where('is_draft', true);
                }
            ])
            ->withCount([
                'banner' =>  function($q) {
                    $q->where('is_draft', true);
                },
                'gallery_image' =>  function($q) {
                    $q->where('is_draft', true);
                },
                'gallery_video' =>  function($q) {
                    $q->where('is_draft', true);
                },
                'plan_category' =>  function($q) {
                    $q->with('plan');
                },
                'amenity',
                'additional_content' =>  function($q) {
                    $q->where('is_draft', true);
                },
                'accomodation' =>  function($q) {
                    $q->where('is_draft', true);
                }
            ])
            ->where('slug', $slug)
            ->where('is_draft', true)
            ->firstOrFail();
        });
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
