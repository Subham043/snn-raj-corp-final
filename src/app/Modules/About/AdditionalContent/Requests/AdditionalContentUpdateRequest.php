<?php

namespace App\Modules\About\AdditionalContent\Requests;

use Illuminate\Support\Facades\Auth;

class AdditionalContentUpdateRequest extends AdditionalContentCreateRequest
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
            'heading' => 'required|string|max:250',
            'button_text' => 'required_with:button_link|string|max:250',
            'button_link' => 'required_with:button_text|url|max:250',
            'description' => 'required|string',
            'description_unfiltered' => 'required|string',
            'image' => 'nullable|image|min:1|max:500',
            'is_draft' => 'required|boolean',
        ];
    }

}
