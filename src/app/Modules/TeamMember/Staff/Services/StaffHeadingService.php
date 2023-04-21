<?php

namespace App\Modules\TeamMember\Staff\Services;

use App\Modules\TeamMember\Staff\Models\StaffHeading;

class StaffHeadingService
{

    public function getById(Int $id): StaffHeading|null
    {
        return StaffHeading::where('id', $id)->first();
    }

    public function createOrUpdate(array $data): StaffHeading
    {
        return StaffHeading::updateOrCreate(
            ['id' => 1],
            [...$data, 'user_id' => auth()->user()->id]
        );
    }

}
