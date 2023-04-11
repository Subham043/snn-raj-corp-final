<?php

namespace App\Modules\HomePage\Testimonial\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\HomePage\Testimonial\Services\TestimonialService;

class TestimonialDeleteController extends Controller
{
    private $testimonialService;

    public function __construct(TestimonialService $testimonialService)
    {
        $this->middleware('permission:delete home page testimonials', ['only' => ['get']]);
        $this->testimonialService = $testimonialService;
    }

    public function get($id){
        $testimonial = $this->testimonialService->getById($id);

        try {
            //code...
            $this->testimonialService->delete(
                $testimonial
            );
            return redirect()->back()->with('success_status', 'Testimonial deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_status', 'Something went wrong. Please try again');
        }
    }

}
