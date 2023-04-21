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
        return AwardHeading::updateOrCreate(
            ['id' => 1],
            [...$data, 'user_id' => auth()->user()->id]
        );
    }

}
