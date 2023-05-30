<?php

namespace App\Modules\About\AdditionalContent\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;


class AdditionalContentCreateRequest extends FormRequest
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
            'heading' => 'required|string|max:250',
            'button_text' => 'required_with:button_link|string|max:250',
            'button_link' => 'required_with:button_text|url|max:250',
            'description' => 'required|string',
            'description_unfiltered' => 'required|string',
            'image' => 'required|image|max:500',
            'is_draft' => 'required|boolean',
            'activate_popup' => 'required|boolean',
            'popup_button_text' => 'required_if:activate_popup,1|string|max:250',
            'popup_description' => 'required_if:activate_popup,1|string',
            'popup_description_unfiltered' => 'required_if:activate_popup,1|string',
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
            'is_draft' => 'Draft',
            'activate_popup' => 'Activate Popup',
            'description' => 'Description',
            'description_unfiltered' => 'Description Unfiltered',
            'button_link' => 'Button Link',
            'button_text' => 'Button Text',
            'image' => 'Image',
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
