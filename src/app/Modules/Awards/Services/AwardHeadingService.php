<?php

namespace App\Modules\Awards\Services;

use App\Modules\Awards\Models\AwardHeading;

class AwardHeadingService
{

    public function getById(Int $id): AwardHeading|null
    {
        return AwardHeading::where('id', $id)->first();
    }

    public function createOrUpdate(array $data): AwardHeading
    {
        $award_heading = AwardHeading::updateOrCreate(
            ['id' => 1],
            [...$data]
        );

        $award_heading->user_id = auth()->user()->id;
        $award_heading->save();

        return $award_heading;
    }

}
