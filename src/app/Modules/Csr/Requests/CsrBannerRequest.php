<?php

namespace App\Modules\Csr\Requests;

use App\Modules\Csr\Services\CsrBannerService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Validation\Rule;


class CsrBannerRequest extends FormRequest
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
            'image' => ['image','min:1','max:500', Rule::requiredIf(function (){
                $banner = (new CsrBannerService)->getById(1);
                return empty($banner->image);
            })],
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
