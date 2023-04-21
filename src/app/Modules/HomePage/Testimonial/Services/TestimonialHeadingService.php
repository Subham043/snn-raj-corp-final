<?php

namespace App\Modules\HomePage\Testimonial\Services;

use App\Modules\HomePage\Testimonial\Models\TestimonialHeading;

class TestimonialHeadingService
{

    public function getById(Int $id): TestimonialHeading|null
    {
        return TestimonialHeading::where('id', $id)->first();
    }

    public function createOrUpdate(array $data): TestimonialHeading
    {
        return TestimonialHeading::updateOrCreate(
            ['id' => 1],
            [...$data, 'user_id' => auth()->user()->id]
        );
    }

}
