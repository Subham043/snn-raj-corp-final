<?php

namespace App\Modules\About\AdditionalContent\Requests;

use Illuminate\Support\Facades\Auth;

class AdditionalContentUpdateRequest extends AdditionalContentCreateRequest
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
            'image' => 'nullable|image|max:500',
            'is_draft' => 'required|boolean',
            'activate_popup' => 'required|boolean',
            'popup_button_text' => 'nullable|required_if:activate_popup,1|string|max:250',
            'popup_description' => 'nullable|required_if:activate_popup,1|string',
            'popup_description_unfiltered' => 'nullable|required_if:activate_popup,1|string',
            'popup_button_slug' => 'nullable|required_if:activate_popup,1|string|max:500|unique:about_contents,popup_button_slug,'.$this->route('id'),
        ];
    }

}
