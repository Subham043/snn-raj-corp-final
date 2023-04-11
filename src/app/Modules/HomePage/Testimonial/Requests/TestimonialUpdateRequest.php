<?php

namespace App\Modules\HomePage\Testimonial\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TestimonialUpdateRequest extends TestimonialCreateRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:250',
            'designation' => 'required|string|max:250',
            'message' => 'required|string|max:500',
            'image' => 'nullable|image|min:10|max:500',
            'is_draft' => 'required|boolean',
        ];
    }

}
