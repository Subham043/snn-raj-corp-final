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

    public function saveImage(Project $project): Project
    {
        $this->deleteImage($project);
        $brochure_bg_image = (new FileService)->save_file('brochure_bg_image', (new Project)->brochure_bg_image_path);
        return $this->update([
            'brochure_bg_image' => $brochure_bg_image,
        ], $project);
    }

    public function saveHomeImage(Project $project): Project
    {
        $this->deleteHomeImage($project);
        $home_image = (new FileService)->save_file('home_image', (new Project)->home_image_path);
        return $this->update([
            'home_image' => $home_image,
        ], $project);
    }

    public function delete(Project $project): bool|null
    {
        $this->deleteBrochure($project);
        $this->deleteImage($project);
        $this->deleteHomeImage($project);
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

    public function deleteImage(Project $project): void
    {
        if($project->brochure_bg_image){
            $path = str_replace("storage","app/public",$project->brochure_bg_image);
            (new FileService)->delete_file($path);
        }
    }

    public function deleteHomeImage(Project $project): void
    {
        if($project->home_image){
            $path = str_replace("storage","app/public",$project->home_image);
            (new FileService)->delete_file($path);
        }
    }

    public function main_all($limit = null)
    {
        $data = Project::with([
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
        ->orderBy('is_completed', 'ASC');
        if($limit){
            $data->limit($limit);
        }
        return $data->get();
    }

    public function main_listing($limit = null)
    {
        $data = Project::select('id', 'name')
        ->where('is_draft', true)
        ->whereHas('banner', function($q) {
            $q->where('is_draft', true);
        })
        ->orderBy('is_completed', 'ASC');
        if($limit){
            $data->limit($limit);
        }
        return $data->get();
    }

    public function home_main_all()
    {
        return Project::select('id', 'slug', 'location', 'name', 'is_completed', 'position', 'home_image')
        ->where('is_draft', true)
        ->whereHas('banner', function($q) {
            $q->where('is_draft', true);
        })
        ->where('use_in_home', true)
        ->orderBy('position', 'ASC')
        ->orderBy('is_completed', 'ASC')
        ->limit(5)
        ->get();
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
                return Project::select('id', 'name', 'slug', 'is_completed', 'brief_description')->with([
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
                        $q->where('is_draft', true)->where('is_completed', $status)->limit(1);
                    })
                    ->orderBy('created_at', 'asc')
                    ->get();
    }

    public function getBySlugMain(String $slug): Project|null
    {
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
        ->orWhere('srd_code', 'LIKE', '%' . $value . '%')
        ->orWhere('description_unfiltered', 'LIKE', '%' . $value . '%');
    }
}
