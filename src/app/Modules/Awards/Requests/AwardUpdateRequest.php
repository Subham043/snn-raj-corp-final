<?php

namespace App\Modules\Awards\Requests;

use Illuminate\Support\Facades\Auth;

class AwardUpdateRequest extends AwardCreateRequest
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
            'year' => 'required|integer|digits:4',
            'title' => 'required|string|max:250',
            'sub_title' => 'required|string|max:250',
            'description' => 'nullable|string|max:500',
            'image' => 'nullable|image|min:1|max:500',
            'is_draft' => 'required|boolean',
        ];
    }

}
