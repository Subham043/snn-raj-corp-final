<?php

namespace App\Modules\TeamMember\Staff\Requests;

use Illuminate\Support\Facades\Auth;

class StaffUpdateRequest extends StaffCreateRequest
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
            'name' => 'required|string|max:250',
            'designation' => 'required|string|max:250',
            'image' => 'nullable|image|min:1|max:500',
            'is_draft' => 'required|boolean',
        ];
    }

}
