<?php

namespace App\Modules\TeamMember\Management\Services;

use App\Modules\TeamMember\Management\Models\ManagementHeading;
use Illuminate\Support\Facades\Cache;

class ManagementHeadingService
{

    public function getById(Int $id): ManagementHeading|null
    {
        return Cache::remember('team_member_management_heading_main_'.$id, 60*60*12, function() use($id){
            return ManagementHeading::where('id', $id)->first();
        });
    }

    public function createOrUpdate(array $data): ManagementHeading
    {
        return ManagementHeading::updateOrCreate(
            ['id' => 1],
            [...$data, 'user_id' => auth()->user()->id]
        );
    }

}
