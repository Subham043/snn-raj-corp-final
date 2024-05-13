<?php

namespace App\Modules\SiteEnquiryRepresentative\Requests;



class SiteEnquiryRepresentativeUpdatePostRequest extends SiteEnquiryRepresentativeCreatePostRequest
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
            'paramantra_code' => 'required|string|max:255',
        ];
    }
}