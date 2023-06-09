<?php

namespace App\Modules\HomePage\About\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;


class AboutRequest extends FormRequest
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
            'sub_heading' => 'required|string|max:250',
            'description' => 'required|string',
            'description_unfiltered' => 'required|string',
            'image' => ['nullable','image','min:1','max:500'],
            'video' => 'required|url|max:500',
            'use_in_banner' => 'required|boolean',
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
            'sub_heading' => 'Sub Heading',
            'description' => 'Description',
            'description_unfiltered' => 'Description Unfiltered',
            'image' => 'Image',
            'video' => 'Video',
            'use_in_banner' => 'Use the video in home page banner',
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
