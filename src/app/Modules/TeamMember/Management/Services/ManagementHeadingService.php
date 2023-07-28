<?php

namespace App\Modules\TeamMember\Management\Services;

use App\Modules\TeamMember\Management\Models\ManagementHeading;
use Illuminate\Support\Facades\Cache;

class ManagementHeadingService
{

    public function getById(Int $id): ManagementHeading|null
    {
        return ManagementHeading::where('id', $id)->first();
    }

    public function createOrUpdate(array $data): ManagementHeading
    {
        $management_heading = ManagementHeading::updateOrCreate(
            ['id' => 1],
            [...$data]
        );

        $management_heading->user_id = auth()->user()->id;
        $management_heading->save();

        return $management_heading;
    }

}
