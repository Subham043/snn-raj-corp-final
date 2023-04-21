<?php

namespace App\Modules\Partner\Services;

use App\Modules\Partner\Models\PartnerHeading;
use Illuminate\Support\Facades\Cache;

class PartnerHeadingService
{

    public function getById(Int $id): PartnerHeading|null
    {
        return Cache::remember('partner_heading_main_'.$id, 60*60*12, function() use($id){
            return PartnerHeading::where('id', $id)->first();
        });
    }

    public function createOrUpdate(array $data): PartnerHeading
    {
        return PartnerHeading::updateOrCreate(
            ['id' => 1],
            [...$data, 'user_id' => auth()->user()->id]
        );
    }

}
