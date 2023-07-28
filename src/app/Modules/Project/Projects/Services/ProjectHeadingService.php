<?php

namespace App\Modules\Project\Projects\Services;

use App\Modules\Project\Projects\Models\ProjectHeading;
use Illuminate\Support\Facades\Cache;

class ProjectHeadingService
{

    public function getById(Int $id): ProjectHeading|null
    {
        return ProjectHeading::where('id', $id)->first();
    }

    public function createOrUpdate(array $data): ProjectHeading
    {
        $project_heading =  ProjectHeading::updateOrCreate(
            ['id' => 1],
            [...$data]
        );

        $project_heading->user_id = auth()->user()->id;
        $project_heading->save();

        return $project_heading;
    }

}
