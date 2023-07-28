<?php

namespace App\Modules\Partner\Services;

use App\Modules\Partner\Models\PartnerHeading;
use Illuminate\Support\Facades\Cache;

class PartnerHeadingService
{

    public function getById(Int $id): PartnerHeading|null
    {
        return PartnerHeading::where('id', $id)->first();
    }

    public function createOrUpdate(array $data): PartnerHeading
    {
        $partner_heading =  PartnerHeading::updateOrCreate(
            ['id' => 1],
            [...$data]
        );

        $partner_heading->user_id = auth()->user()->id;
        $partner_heading->save();

        return $partner_heading;
    }

}
