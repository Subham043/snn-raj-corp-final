<?php

namespace App\Modules\HomePage\Testimonial\Requests;

use Illuminate\Support\Facades\Auth;

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
            'video' => 'required|url|max:500',
            'video_title' => 'nullable|string|max:500',
            'is_draft' => 'required|boolean',
        ];
    }

}
