<?php

namespace App\Modules\HomePage\Testimonial\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\HomePage\Testimonial\Services\TestimonialHeadingService;
use App\Modules\HomePage\Testimonial\Services\TestimonialService;
use Illuminate\Http\Request;

class TestimonialPaginateController extends Controller
{
    private $testimonialService;
    private $testimonialHeadingService;

    public function __construct(TestimonialService $testimonialService, TestimonialHeadingService $testimonialHeadingService)
    {
        $this->middleware('permission:list home page testimonials', ['only' => ['get']]);
        $this->testimonialService = $testimonialService;
        $this->testimonialHeadingService = $testimonialHeadingService;
    }

    public function get(Request $request){
        $testimonialHeading = $this->testimonialHeadingService->getById(1);
        $data = $this->testimonialService->paginate($request->total ?? 10);
        return view('admin.pages.home_page.testimonial.paginate', compact(['data', 'testimonialHeading']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
