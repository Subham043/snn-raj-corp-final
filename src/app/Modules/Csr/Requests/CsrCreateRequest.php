<?php

namespace App\Modules\Csr\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;


class CsrCreateRequest extends FormRequest
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
            'description' => 'required|string',
            'description_unfiltered' => 'required|string',
            'image_title' => 'nullable|string|max:250',
            'image_alt' => 'nullable|string|max:250',
            'image' => 'required|image|min:1|max:500',
            'is_draft' => 'required|boolean',
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
            'description' => 'Description',
            'description_unfiltered' => 'Description Unfiltered',
            'image_title' => 'Image Title',
            'image_alt' => 'Image Alt',
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
