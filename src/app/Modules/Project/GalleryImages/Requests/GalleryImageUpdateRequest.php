<?php

namespace App\Modules\Project\GalleryImages\Requests;


class GalleryImageUpdateRequest extends GalleryImageCreateRequest
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
            'image_alt' => 'nullable|string|max:500',
            'image_title' => 'nullable|string|max:500',
        ];
    }

}