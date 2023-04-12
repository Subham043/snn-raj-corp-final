<?php

namespace App\Modules\Legal\Requests;

use Illuminate\Support\Facades\Auth;

class LegalUpdateRequest extends LegalCreateRequest
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
            'page_name' => 'nullable|string|max:250',
            'slug' => 'nullable|string|max:250|unique:legal_contents,slug,'.$this->route('id'),
            'is_draft' => 'required|boolean',
        ];
    }

}
