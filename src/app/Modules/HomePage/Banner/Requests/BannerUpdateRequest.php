<?php

namespace App\Modules\HomePage\Banner\Requests;

use App\Modules\HomePage\Banner\Services\BannerService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class BannerUpdateRequest extends BannerCreateRequest
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
            'banner_image' => ['nullable','image', 'min:10', 'max:500','prohibited_if:is_banner_image,false', Rule::requiredIf(function (){
                $banner = (new BannerService)->getById($this->route('id'));
                return $this->is_banner_image && !$banner->is_banner_image;
            }),],
            'banner_image_alt' => 'nullable|string|max:500|prohibited_if:is_banner_image,false',
            'banner_image_title' => 'nullable|string|max:500|prohibited_if:is_banner_image,false',
            'banner_video' => 'required_if:is_banner_image,false|url|max:500|prohibited_if:is_banner_image,true',
            'banner_video_title' => 'nullable|string|max:500|prohibited_if:is_banner_image,true',
        ];
    }

}
