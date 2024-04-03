<?php

namespace App\Modules\SiteEnquiryExecutive\Requests;

use Illuminate\Validation\Rules\Password;


class SiteEnquiryExecutiveUpdatePostRequest extends SiteEnquiryExecutiveCreatePostRequest
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
            'email' => 'required|string|email|max:255|unique:site_enquiry_executives,email,'.$this->route('id'),
            'password_confirmation' => 'nullable|string|min:8|required_with:password|same:password',
            'password' => ['nullable',
                'string',
                Password::min(8)
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
                        ->uncompromised()
            ],
        ];
    }
}