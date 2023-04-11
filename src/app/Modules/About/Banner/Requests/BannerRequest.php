<?php

namespace App\Modules\About\Banner\Requests;

use App\Modules\About\Banner\Services\BannerService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;
use Illuminate\Validation\Rule;


class BannerRequest extends FormRequest
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
            'button_text' => 'required|string|max:250',
            'button_link' => 'required|url|max:250',
            'description' => 'required|string|max:500',
            'mission' => 'required|string|max:500',
            'vission' => 'required|string|max:500',
            'image' => ['image','min:10','max:500', Rule::requiredIf(function (){
                $banner = (new BannerService)->getById(1);
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
            'button_text' => 'Button Text',
            'button_link' => 'Button Link',
            'description' => 'Description',
            'mission' => 'Mission',
            'vission' => 'Vission',
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
