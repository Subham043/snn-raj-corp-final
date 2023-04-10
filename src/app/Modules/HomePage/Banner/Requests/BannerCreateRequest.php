<?php

namespace App\Modules\HomePage\Banner\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;


class BannerCreateRequest extends FormRequest
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
            'title' => 'required|string|max:250',
            'description' => 'required|string|max:500',
            'button_link' => 'nullable|url|max:500',
            'is_banner_image' => 'required|boolean',
            'is_draft' => 'required|boolean',
            'banner_image' => 'required_if:is_banner_image,true|image|min:10|max:500|prohibited_if:is_banner_image,false',
            'banner_image_alt' => 'nullable|string|max:500|prohibited_if:is_banner_image,false',
            'banner_image_title' => 'nullable|string|max:500|prohibited_if:is_banner_image,false',
            'banner_video' => 'required_if:is_banner_image,false|url|max:500|prohibited_if:is_banner_image,true',
            'banner_video_title' => 'nullable|string|max:500|prohibited_if:is_banner_image,true',
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
            'is_banner_image' => 'Image-Video Switch',
            'is_draft' => 'Draft',
            'banner_image' => 'Image',
            'banner_image_alt' => 'Image Alt',
            'banner_image_title' => 'Image Title',
            'banner_video' => 'Video',
            'banner_video_title' => 'Video Title',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'banner_image.required_if' => 'The Image field is required when Image-Video Switch is On',
            'banner_video.required_if' => 'The Video field is required when Image-Video Switch is Off',
        ];
    }

    /**
     * Handle a passed validation attempt.
     *
     * @return void
     */
    protected function passedValidation()
    {
        $this->replace(
            Purify::clean(
                $this->validated()
            )
        );
    }
}
