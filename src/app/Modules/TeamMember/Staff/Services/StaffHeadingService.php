<?php

namespace App\Modules\TeamMember\Staff\Services;

use App\Modules\TeamMember\Staff\Models\StaffHeading;
use Illuminate\Support\Facades\Cache;

class StaffHeadingService
{

    public function getById(Int $id): StaffHeading|null
    {
        return Cache::remember('team_member_staff_heading_main_'.$id, 60*60*24, function() use($id){
            return StaffHeading::where('id', $id)->first();
        });
    }

    public function createOrUpdate(array $data): StaffHeading
    {
        $staff_heading = StaffHeading::updateOrCreate(
            ['id' => 1],
            [...$data]
        );

        $staff_heading->user_id = auth()->user()->id;
        $staff_heading->save();

        return $staff_heading;
    }

}
