<?php

namespace App\Modules\HomePage\Testimonial\Services;

use App\Modules\HomePage\Testimonial\Models\TestimonialHeading;
use Illuminate\Support\Facades\Cache;

class TestimonialHeadingService
{

    public function getById(Int $id): TestimonialHeading|null
    {
        return Cache::remember('testimonial_heading_'.$id, 60*60*24, function() use($id){
            return TestimonialHeading::where('id', $id)->first();
        });
    }

    public function createOrUpdate(array $data): TestimonialHeading
    {
        return TestimonialHeading::updateOrCreate(
            ['id' => 1],
            [...$data, 'user_id' => auth()->user()->id]
        );
    }

}
