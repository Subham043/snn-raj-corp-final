<?php

namespace App\Modules\TeamMember\Staff\Services;

use App\Modules\TeamMember\Staff\Models\StaffHeading;
use Illuminate\Support\Facades\Cache;

class StaffHeadingService
{

    public function getById(Int $id): StaffHeading|null
    {
        return Cache::remember('team_member_staff_heading_main_'.$id, 60*60*12, function() use($id){
            return StaffHeading::where('id', $id)->first();
        });
    }

    public function createOrUpdate(array $data): StaffHeading
    {
        return StaffHeading::updateOrCreate(
            ['id' => 1],
            [...$data, 'user_id' => auth()->user()->id]
        );
    }

}
