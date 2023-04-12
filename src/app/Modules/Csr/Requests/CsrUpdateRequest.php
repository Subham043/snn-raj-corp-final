<?php

namespace App\Modules\Csr\Requests;

use Illuminate\Support\Facades\Auth;

class CsrUpdateRequest extends CsrCreateRequest
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
            'description' => 'required|string',
            'description_unfiltered' => 'required|string',
            'image_title' => 'nullable|string|max:250',
            'image_alt' => 'nullable|string|max:250',
            'image' => 'nullable|image|min:10|max:500',
            'is_draft' => 'required|boolean',
        ];
    }

}
