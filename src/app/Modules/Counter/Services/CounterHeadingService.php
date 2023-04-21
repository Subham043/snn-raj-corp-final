<?php

namespace App\Modules\Counter\Services;

use App\Http\Services\FileService;
use App\Modules\Counter\Models\CounterHeading;

class CounterHeadingService
{

    public function getById(Int $id): CounterHeading|null
    {
        return CounterHeading::where('id', $id)->first();
    }

    public function createOrUpdate(array $data): CounterHeading
    {
        return CounterHeading::updateOrCreate(
            ['id' => 1],
            [...$data, 'user_id' => auth()->user()->id]
        );
    }

}
