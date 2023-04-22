<?php

namespace App\Modules\Counter\Services;

use App\Modules\Counter\Models\CounterHeading;
use Illuminate\Support\Facades\Cache;

class CounterHeadingService
{

    public function getById(Int $id): CounterHeading|null
    {
        return Cache::remember('counter_heading_'.$id, 60*60*24, function() use($id){
            return CounterHeading::where('id', $id)->first();
        });
    }

    public function createOrUpdate(array $data): CounterHeading
    {
        $counter_heading =  CounterHeading::updateOrCreate(
            ['id' => 1],
            [...$data]
        );

        $counter_heading->user_id = auth()->user()->id;
        $counter_heading->save();

        return $counter_heading;
    }

}
