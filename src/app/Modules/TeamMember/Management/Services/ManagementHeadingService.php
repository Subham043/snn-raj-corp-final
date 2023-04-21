<?php

namespace App\Modules\TeamMember\Management\Services;

use App\Modules\TeamMember\Management\Models\ManagementHeading;

class ManagementHeadingService
{

    public function getById(Int $id): ManagementHeading|null
    {
        return ManagementHeading::where('id', $id)->first();
    }

    public function createOrUpdate(array $data): ManagementHeading
    {
        return ManagementHeading::updateOrCreate(
            ['id' => 1],
            [...$data, 'user_id' => auth()->user()->id]
        );
    }

}
