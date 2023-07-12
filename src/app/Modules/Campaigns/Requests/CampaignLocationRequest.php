<?php

namespace App\Modules\Campaigns\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;


class CampaignLocationRequest extends FormRequest
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
            'location_heading' => 'required|string',
            'description' => 'required|string',
            'location' => 'required|url',
            'map_image' => 'required|image|mimes:jpeg,png,jpg,webp,avif',
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
            'location_heading' => 'Heading',
            'map_image' => 'Map Image',
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
