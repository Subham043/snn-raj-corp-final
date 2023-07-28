<?php

namespace App\Modules\Enquiry\ReferalForm\Requests;

use App\Http\Services\RateLimitService;
use Illuminate\Foundation\Http\FormRequest;
use Stevebauman\Purify\Facades\Purify;


class ReferalFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        (new RateLimitService($this))->ensureIsNotRateLimited(3);
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'member_name' => 'required|string|max:255',
            'member_email' => 'required|string|email|max:255',
            'country_code_1' => 'required|string|max:255',
            'member_phone' => 'required|numeric|digits:10',
            'member_unit' => 'required|string|max:255',
            'member_project_id' => 'required|numeric|exists:App\Modules\Project\Projects\Models\Project,id',
            'referal_name' => 'required|string|max:255',
            'referal_email' => 'required|string|email|max:255',
            'country_code_2' => 'required|string|max:255',
            'referal_phone' => 'required|numeric|digits:10',
            'referal_relation' => 'required|string|max:255',
            'referal_project_id' => 'required|numeric|exists:App\Modules\Project\Projects\Models\Project,id',
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
