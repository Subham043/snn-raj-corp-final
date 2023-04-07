<?php

namespace App\Modules\Settings\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;


class EmailSettingRequest extends FormRequest
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
            'mailer' => 'required|string|max:500',
            'host' => 'required|string|max:500',
            'port' => 'required|integer',
            'username' => 'required|string|max:500',
            'password' => 'nullable|string|max:500',
            'encryption' => 'required|string|max:500',
            'from_address' => 'required|string|email|max:500',
            'from_name' => 'required|string|max:500',
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
