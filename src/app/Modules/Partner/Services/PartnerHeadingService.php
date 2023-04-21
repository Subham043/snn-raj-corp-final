<?php

namespace App\Modules\Partner\Services;

use App\Modules\Partner\Models\PartnerHeading;

class PartnerHeadingService
{

    public function getById(Int $id): PartnerHeading|null
    {
        return PartnerHeading::where('id', $id)->first();
    }

    public function createOrUpdate(array $data): PartnerHeading
    {
        return PartnerHeading::updateOrCreate(
            ['id' => 1],
            [...$data, 'user_id' => auth()->user()->id]
        );
    }

}
