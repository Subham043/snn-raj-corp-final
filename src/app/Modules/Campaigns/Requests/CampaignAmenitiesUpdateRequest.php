<?php

namespace App\Modules\Campaigns\Requests;


class CampaignAmenitiesUpdateRequest extends CampaignAmenitiesCreateRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:500',
            'icon_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif',
        ];
    }
}
