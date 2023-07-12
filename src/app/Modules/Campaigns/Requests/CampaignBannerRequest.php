<?php

namespace App\Modules\Campaigns\Requests;

use App\Modules\Campaigns\Models\CampaignBanner;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Validation\Rule;


class CampaignBannerRequest extends FormRequest
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
            'heading' => 'required|string|max:500',
            'sub_heading' => 'nullable|string|max:500',
            'points' => 'required|string',
            'banner_image' => ['image','mimes:jpeg,png,jpg,webp,avif', Rule::requiredIf(function (){
                $banner_image = CampaignBanner::where('campaign_id', $this->route('campaign_id'))->first();
                return empty($banner_image->banner_image);
            })],
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
            'heading' => 'Heading',
            'banner_image' => 'Banner Image',
            'sub_heading' => 'Sub Heading',
            'points' => 'Points',
        ];
    }

    /**
     * Handle a passed validation attempt.
     *
     * @return void
     */
    protected function passedValidation()
    {
        $request = $this->validated();
        $this->replace(Purify::clean($request));
    }
}
