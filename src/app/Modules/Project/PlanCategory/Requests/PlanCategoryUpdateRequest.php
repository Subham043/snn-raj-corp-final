<?php

namespace App\Modules\Project\PlanCategory\Requests;


class PlanCategoryUpdateRequest extends PlanCategoryCreateRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:500',
        ];
    }

}
