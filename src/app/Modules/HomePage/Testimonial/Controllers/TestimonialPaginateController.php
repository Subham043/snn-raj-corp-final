<?php

namespace App\Modules\HomePage\Testimonial\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\HomePage\Testimonial\Services\TestimonialService;
use Illuminate\Http\Request;

class TestimonialPaginateController extends Controller
{
    private $testimonialService;

    public function __construct(TestimonialService $testimonialService)
    {
        $this->middleware('permission:list home page testimonials', ['only' => ['get']]);
        $this->testimonialService = $testimonialService;
    }

    public function get(Request $request){
        $data = $this->testimonialService->paginate($request->total ?? 10);
        return view('admin.pages.home_page.testimonial.paginate', compact(['data']))
            ->with('search', $request->query('filter')['search'] ?? '');
    }

}
