<?php

namespace App\Modules\Project\GalleryImages\Requests;

use App\Enums\ProjectGalleryStatusEnum;
use Illuminate\Validation\Rules\Enum;


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
            'type' => ['required', new Enum(ProjectGalleryStatusEnum::class)],
            'image' => 'nullable|image|max:500',
            'image_alt' => 'nullable|string|max:500',
            'image_title' => 'nullable|string|max:500',
        ];
    }

}
