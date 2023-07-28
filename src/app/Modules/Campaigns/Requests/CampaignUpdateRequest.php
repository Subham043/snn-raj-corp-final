<?php

namespace App\Modules\Campaigns\Requests;

use Stevebauman\Purify\Facades\Purify;
use App\Enums\CampaignStatusEnum;
use App\Enums\PublishStatusEnum;


class CampaignUpdateRequest extends CampaignCreateRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'srd' => 'required|string|max:255',
            'slug' => 'required|string|max:250|unique:campaigns,slug,'.$this->route('id'),
            'phone' => 'nullable|integer|digits:10',
            'email' => 'nullable|string|email|max:255',
            'address' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'og_locale' => 'nullable|string',
            'og_type' => 'nullable|string',
            'og_description' => 'nullable|string',
            'og_site_name' => 'nullable|string',
            'meta_header' => 'nullable|string',
            'meta_footer' => 'nullable|string',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'youtube' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'header_logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif',
            'footer_logo' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif',
            'campaign_status' => 'nullable',
            'publish_status' => 'nullable',
        ];
    }

}
