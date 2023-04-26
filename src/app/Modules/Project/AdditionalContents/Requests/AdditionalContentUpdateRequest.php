<?php

namespace App\Modules\Project\AdditionalContents\Requests;


class AdditionalContentUpdateRequest extends AdditionalContentCreateRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'is_draft' => 'required|boolean',
            'heading' => 'required|string|max:250',
            'description' => 'required|string',
            'description_unfiltered' => 'required|string',
            'image' => 'nullable|image|min:10|max:500',
        ];
    }

}
