<?php

namespace App\Modules\Awards\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;


class AwardCreateRequest extends FormRequest
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
            'year' => 'required|integer|digits:4',
            'title' => 'required|string|max:250',
            'sub_title' => 'required|string|max:250',
            'description' => 'nullable|string|max:500',
            'image' => 'required|image|max:500',
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
            'year' => 'Year',
            'title' => 'Title',
            'is_draft' => 'Draft',
            'description' => 'Description',
            'sub_title' => 'Sub Title',
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
