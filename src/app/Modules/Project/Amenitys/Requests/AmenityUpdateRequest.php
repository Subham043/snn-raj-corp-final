<?php

namespace App\Modules\Project\Amenitys\Requests;


class AmenityUpdateRequest extends AmenityCreateRequest
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
            'image' => 'nullable|image|min:10|max:500',
            'title' => 'required|string|max:500',
        ];
    }

}
