<?php

namespace App\Modules\Campaigns\Requests;

use App\Enums\CampaignStatusEnum;
use App\Enums\PublishStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;


class CampaignCreateRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'srd' => 'nullable|string|max:255',
            'projectId' => 'nullable|string|max:255',
            'slug' => 'required|string|max:250|unique:campaigns,slug',
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
            'header_logo' => 'required|image|mimes:jpeg,png,jpg,webp,avif',
            'footer_logo' => 'required|image|mimes:jpeg,png,jpg,webp,avif',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,avif',
            'brochure_bg_image' => 'required|image|mimes:jpeg,png,jpg,webp,avif',
            'campaign_status' => 'nullable',
            'publish_status' => 'nullable',
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
            'name' => 'Campaign Name',
            'email' => 'Campaign Email',
            'phone' => 'Campaign Phone',
            'address' => 'Campaign Address',
            'og_image' => 'Og Image',
            'header_logo' => 'Header Logo',
            'footer_logo' => 'Footer Logo',
            'brochure_bg_image' => 'Brochure Background Image',
            'srd' => 'SellDo SRD Code',
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
        $request = $this->validated();
        $request['campaign_status'] = empty($request['campaign_status']) ? CampaignStatusEnum::COMPLETED->label() : ($request['campaign_status'] == "on" ? CampaignStatusEnum::UPCOMING->label() : CampaignStatusEnum::COMPLETED->label());
        $request['publish_status'] = empty($request['publish_status']) ? PublishStatusEnum::DRAFT->label() : ($request['publish_status'] == "on" ? PublishStatusEnum::ACTIVE->label() : PublishStatusEnum::DRAFT->label());
        $meta_header = $request['meta_header'];
        $meta_footer = $request['meta_footer'];
        $request = Purify::clean($request);
        $request['meta_header'] = $meta_header;
        $request['meta_footer'] = $meta_footer;
        $this->replace($request);
    }
}
