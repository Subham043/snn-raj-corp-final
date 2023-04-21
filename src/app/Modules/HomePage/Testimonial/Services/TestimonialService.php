<?php

namespace App\Modules\HomePage\Testimonial\Services;

use App\Http\Services\FileService;
use App\Modules\HomePage\Testimonial\Models\Testimonial;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Spatie\QueryBuilder\AllowedFilter;

class TestimonialService
{

    public function all(): Collection
    {
        return Testimonial::all();
    }

    public function paginate(Int $total = 10): LengthAwarePaginator
    {
        $query = Testimonial::latest();
        return QueryBuilder::for($query)
                ->allowedFilters([
                    AllowedFilter::custom('search', new CommonFilter),
                ])
                ->paginate($total)
                ->appends(request()->query());
    }

    public function getById(Int $id): Testimonial
    {
        return Testimonial::findOrFail($id);
    }

    public function create(array $data): Testimonial
    {
        $testimonial = Testimonial::create($data);
        $testimonial->user_id = auth()->user()->id;
        $testimonial->save();
        return $testimonial;
    }

    public function update(array $data, Testimonial $testimonial): Testimonial
    {
        $testimonial->update($data);
        return $testimonial;
    }

    public function saveImage(Testimonial $testimonial): Testimonial
    {
        $this->deleteImage($testimonial);
        $image = (new FileService)->save_file('image', (new Testimonial)->image_path);
        return $this->update([
            'image' => $image,
        ], $testimonial);
    }

    public function delete(Testimonial $testimonial): bool|null
    {
        $this->deleteImage($testimonial);
        return $testimonial->delete();
    }

    public function deleteImage(Testimonial $testimonial): void
    {
        if($testimonial->image){
            $path = str_replace("storage","app/public",$testimonial->image);
            (new FileService)->delete_file($path);
        }
    }

    public function main_all(): Collection
    {
        return Cache::remember('home_page_testimonials_main', 60*60*24, function(){
            return Testimonial::where('is_draft', true)->latest()->get();
        });
    }

}

class CommonFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $query->where('name', 'LIKE', '%' . $value . '%')
        ->orWhere('designation', 'LIKE', '%' . $value . '%')
        ->orWhere('message', 'LIKE', '%' . $value . '%');
    }
}
