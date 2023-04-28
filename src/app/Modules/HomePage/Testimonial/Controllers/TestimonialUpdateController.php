<?php

namespace App\Modules\HomePage\Testimonial\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\HomePage\Testimonial\Requests\TestimonialUpdateRequest;
use App\Modules\HomePage\Testimonial\Services\TestimonialService;

class TestimonialUpdateController extends Controller
{
    private $testimonialService;

    public function __construct(TestimonialService $testimonialService)
    {
        $this->middleware('permission:edit home page testimonials', ['only' => ['get','post']]);
        $this->testimonialService = $testimonialService;
    }

    public function get($id){
        $data = $this->testimonialService->getById($id);
        return view('admin.pages.home_page.testimonial.update', compact('data'));
    }

    public function post(TestimonialUpdateRequest $request, $id){
        $testimonial = $this->testimonialService->getById($id);
        try {
            //code...
            $this->testimonialService->update(
                $request->validated(),
                $testimonial
            );
            return response()->json(["message" => "Testimonial updated successfully."], 201);
        } catch (\Throwable $th) {
            return response()->json(["message" => "Something went wrong. Please try again"], 400);
        }

    }
}
