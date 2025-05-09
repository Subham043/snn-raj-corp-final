<?php

namespace App\Modules\Project\Projects\Requests;

use Illuminate\Support\Facades\Auth;

class ProjectUpdateRequest extends ProjectCreateRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:500',
            'srd_code' => 'nullable|string|max:500',
            'projectId' => 'nullable|string|max:500',
            'slug' => 'required|string|max:500|unique:projects,slug,'.$this->route('id'),
            'location' => 'required|string|max:500',
            'floor' => 'required|string|max:500',
            'acre' => 'required|string|max:500',
            'tower' => 'required|string|max:500',
            'rera' => 'nullable|string|max:500',
            'address' => 'required|string|max:500',
            'map_location_link' => 'nullable|url|max:500',
            'brief_description' => 'required|string|max:500',
            'description' => 'required|string',
            'description_unfiltered' => 'required|string',
            'brochure' => 'nullable|mimes:pdf|max:5000',
            'brochure_bg_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif',
            'video' => 'required_if:use_in_banner,1|url|max:500|nullable',
            'use_in_banner' => 'required|boolean',
            'use_in_home' => 'required|boolean',
            'home_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif',
            'position' => 'nullable|required_if:use_in_home,1|integer',
            'amenity' => 'required|array|min:4',
            'amenity.*' => 'required|numeric|exists:project_common_amenities,id',
            'is_draft' => 'required|boolean',
            'is_completed' => 'required|boolean',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'page_keywords' => 'nullable|string',
            'meta_header_script' => 'nullable|string',
            'meta_footer_script' => 'nullable|string',
            'meta_header_no_script' => 'nullable|string',
            'meta_footer_no_script' => 'nullable|string',
        ];
    }

}
