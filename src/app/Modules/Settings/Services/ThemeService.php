<?php

namespace App\Modules\Settings\Services;

use App\Modules\Settings\Models\Theme;
use Illuminate\Support\Facades\Cache;

class ThemeService
{

    public function getById(Int $id): Theme|null
    {
        return Theme::where('id', $id)->first();
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
