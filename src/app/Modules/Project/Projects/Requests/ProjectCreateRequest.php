<?php

namespace App\Modules\Project\Projects\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;


class ProjectCreateRequest extends FormRequest
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
            'name' => 'required|string|max:500',
            'srd_code' => 'nullable|string|max:500',
            'projectId' => 'nullable|string|max:500',
            'slug' => 'required|string|max:500|unique:projects,slug',
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
            'brochure_bg_image' => 'required|image|mimes:jpeg,png,jpg,webp,avif',
            'video' => 'required_if:use_in_banner,1|url|max:500|nullable',
            'use_in_banner' => 'required|boolean',
            'use_in_home' => 'required|boolean',
            'home_image' => 'nullable|required_if:use_in_home,1|image|mimes:jpeg,png,jpg,webp,avif',
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

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'is_draft' => 'Draft',
            'is_completed' => 'Completed',
            'video' => 'Video',
            'use_in_banner' => 'Use the video in project page banner',
            'brochure_bg_image' => 'Brochure Background Image',
            'use_in_home' => 'Use the project in home page',
            'home_image' => 'Home Page Project Image',
            'position' => 'Home Page Project Image Position',
            'srd_code' => 'SellDo SRD Code',
            'projectId' => 'SellDo Project ID',
        ];
    }

    /**
     * Handle a passed validation attempt.
     *
     * @return void
     */
    protected function passedValidation()
    {
        $request = Purify::clean(
            $this->except(['meta_header_script', 'meta_footer_script', 'meta_header_no_script', 'meta_footer_no_script'])
        );
        $this->replace(
            [...$request, ...$this->only(['meta_header_script', 'meta_footer_script', 'meta_header_no_script', 'meta_footer_no_script'])]
        );
    }
}
