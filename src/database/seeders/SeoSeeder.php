<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Modules\Seo\Models\Seo;
use Illuminate\Database\Seeder;

class SeoSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //seo for main pages

        Seo::create([
            'page_name' => 'Home Page',
            'slug' => 'home-page',
        ]);

        Seo::create([
            'page_name' => 'About Page',
            'slug' => 'about-page',
        ]);

        Seo::create([
            'page_name' => 'Project Ongoing Page',
            'slug' => 'project-ongoing-page',
        ]);

        Seo::create([
            'page_name' => 'Project Completed Page',
            'slug' => 'project-completed-page',
        ]);

        Seo::create([
            'page_name' => 'Award Page',
            'slug' => 'award-page',
        ]);

        Seo::create([
            'page_name' => 'Csr Page',
            'slug' => 'csr-page',
        ]);

        Seo::create([
            'page_name' => 'Blog Page',
            'slug' => 'blog-page',
        ]);

        Seo::create([
            'page_name' => 'Contact Page',
            'slug' => 'contact-page',
        ]);

    }
}
