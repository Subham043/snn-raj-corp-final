<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Modules\Settings\Models\Theme;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //seo for main pages

        Theme::create([
            'background_color' => '#1b1b1b',
            'primary_color' => '#dccc73',
            'overlay_color' => '#000000',
            'lines_color' => '#ffffff',
            'text_color' => '#999999',
            'highlight_text_color' => '#ffffff',
        ]);
    }
}
