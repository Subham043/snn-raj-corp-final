<?php

namespace App\Modules\HomePage\Testimonial\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\HomePage\Testimonial\Requests\TestimonialCreateRequest;
use App\Modules\HomePage\Testimonial\Services\TestimonialService;

class TestimonialCreateController extends Controller
{
    private $testimonialService;

    public function __construct(TestimonialService $testimonialService)
    {
        $this->middleware('permission:create home page testimonials', ['only' => ['get','post']]);
        $this->testimonialService = $testimonialService;
    }

    public function get(){
        return view('admin.pages.home_page.testimonial.create');
    }

    public function post(TestimonialCreateRequest $request){

        try {
            //code...
            $testimonial = $this->testimonialService->create(
                $request->except('image')
            );
            if($request->image==true && $request->hasFile('image')){
                $this->testimonialService->saveImage($testimonial);
            }
            return response()->json(["message" => "Testimonial created successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
