<?php

namespace App\Modules\Project\CommonAmenitys\Requests;


class CommonAmenityUpdateRequest extends CommonAmenityCreateRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image' => 'nullable|image|min:1|max:500',
            'title' => 'required|string|max:500',
        ];
    }

}
