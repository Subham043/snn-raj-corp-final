<?php

namespace App\Modules\Settings\Services;

use App\Modules\Settings\Models\Theme;
use Illuminate\Support\Facades\Cache;

class ThemeService
{

    public function getById(Int $id): Theme|null
    {
        return Cache::remember('theme_settings_main_'.$id, 60*60*24, function() use($id){
            return Theme::where('id', $id)->first();
        });
    }

    public function createOrUpdate(array $data): Theme
    {
        $theme = Theme::updateOrCreate(
            ['id' => 1],
            [...$data]
        );

        $theme->user_id = auth()->user()->id;
        $theme->save();

        return $theme;
    }

}
