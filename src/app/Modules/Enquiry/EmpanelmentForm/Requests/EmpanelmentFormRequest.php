<?php

namespace App\Modules\Enquiry\EmpanelmentForm\Requests;

use App\Http\Services\RateLimitService;
use Illuminate\Foundation\Http\FormRequest;
use Stevebauman\Purify\Facades\Purify;


class EmpanelmentFormRequest extends FormRequest
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
            'scope' => 'required|string|max:255',
            'company_type' => 'required|string|max:255',
            'channel_partner' => 'required|string|max:255',
            'country_code' => 'required|string|max:255',
            'phone' => 'required|numeric|digits:10|unique:empanelment_forms,phone',
            'telephone' => 'required|numeric',
            'email' => 'required|string|email',
            'rera' => 'required|string|max:255',
            'contact_person_name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'pan' => 'required|string|max:255',
            'gst' => 'required|string|max:255',
            'sac' => 'required|string|max:255',
            'tax' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
            'bank_address' => 'required|string|max:255',
            'bank_branch' => 'required|string|max:255',
            'bank_account_number' => 'required|string|max:255',
            'ifsc' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'pan_image' => 'required|mimes:jpg,png,jpeg,webp,pdf|max:30000',
            'gst_image' => 'required|mimes:jpg,png,jpeg,webp,pdf|max:30000',
            'seal_image' => 'required|mimes:jpg,png,jpeg,webp,pdf|max:30000',
            'cheque_image' => 'required|mimes:jpg,png,jpeg,webp,pdf|max:30000',
            'rera_image' => 'required|mimes:jpg,png,jpeg,webp,pdf|max:30000',
            'msme_image' => 'required_if:msme,1|mimes:jpg,png,jpeg,webp,pdf|max:30000|nullable',
            'msme' => 'required|boolean',
            'esi' => 'required|boolean',
            'epf' => 'required|boolean',
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
            'scope' => 'Scope of Work',
            'channel_partner' => 'Name of Channel Partner',
            'phone' => 'Phone',
            'telephone' => 'Telephone',
            'email' => 'Email',
            'rera' => 'RERA No.',
            'contact_person_name' => 'Contact Person Name',
            'designation' => 'Designation',
            'pan' => 'PAN No.',
            'gst' => 'GSTIN',
            'sac' => 'SAC / HSN Code',
            'tax' => 'Tax Applicable',
            'bank_name' => 'Bank Name',
            'bank_address' => 'Bank Address',
            'bank_branch' => 'Bank Branch',
            'bank_account_number' => 'Bank Account Number',
            'ifsc' => 'IFSC Code',
            'address' => 'Address',
            'pan_image' => 'Pan Copy',
            'gst_image' => 'GST Certificate Copy',
            'seal_image' => 'Print on A4 paper with seal and signature',
            'cheque_image' => 'Cancelled Cheque copy or front copy of passbook',
            'rera_image' => 'RERA Certificate',
            'msme_image' => 'MSME Certificate',
            'msme' => 'MSME Registered',
            'esi' => 'ESI Registered',
            'epf' => 'EPF Registered',
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