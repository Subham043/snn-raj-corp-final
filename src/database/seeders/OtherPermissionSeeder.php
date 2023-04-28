<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class OtherPermissionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //permission unrelated to main app

        //permission for home page banners
        Permission::create(['name' => 'edit home page banners']);
        Permission::create(['name' => 'delete home page banners']);
        Permission::create(['name' => 'create home page banners']);
        Permission::create(['name' => 'list home page banners']);

        //permission for home page testimonials
        Permission::create(['name' => 'edit home page testimonials']);
        Permission::create(['name' => 'delete home page testimonials']);
        Permission::create(['name' => 'create home page testimonials']);
        Permission::create(['name' => 'list home page testimonials']);

        //permission for home page about
        Permission::create(['name' => 'edit home page about']);

        //permission for awards
        Permission::create(['name' => 'edit awards']);
        Permission::create(['name' => 'delete awards']);
        Permission::create(['name' => 'create awards']);
        Permission::create(['name' => 'list awards']);

        //permission for partners
        Permission::create(['name' => 'edit partners']);
        Permission::create(['name' => 'delete partners']);
        Permission::create(['name' => 'create partners']);
        Permission::create(['name' => 'list partners']);

        //permission for counters
        Permission::create(['name' => 'edit counters']);
        Permission::create(['name' => 'delete counters']);
        Permission::create(['name' => 'create counters']);
        Permission::create(['name' => 'list counters']);

        //permission for team member managements
        Permission::create(['name' => 'edit team member managements']);
        Permission::create(['name' => 'delete team member managements']);
        Permission::create(['name' => 'create team member managements']);
        Permission::create(['name' => 'list team member managements']);

        //permission for team member staffs
        Permission::create(['name' => 'edit team member staffs']);
        Permission::create(['name' => 'delete team member staffs']);
        Permission::create(['name' => 'create team member staffs']);
        Permission::create(['name' => 'list team member staffs']);

        //permission for about banner
        Permission::create(['name' => 'edit about banner']);

        //permission for about main
        Permission::create(['name' => 'edit about main']);

        //permission for about additional content
        Permission::create(['name' => 'edit about additional content']);
        Permission::create(['name' => 'delete about additional content']);
        Permission::create(['name' => 'create about additional content']);
        Permission::create(['name' => 'list about additional content']);

        //permission for csr banner
        Permission::create(['name' => 'edit csr banner']);

        //permission for csr content
        Permission::create(['name' => 'edit csr content']);
        Permission::create(['name' => 'delete csr content']);
        Permission::create(['name' => 'create csr content']);
        Permission::create(['name' => 'list csr content']);

        //permission for legal pages
        Permission::create(['name' => 'edit legal pages']);
        Permission::create(['name' => 'list legal pages']);

        //permission for pages seo
        Permission::create(['name' => 'edit pages seo']);
        Permission::create(['name' => 'list pages seo']);

        //permission for projects
        Permission::create(['name' => 'edit projects']);
        Permission::create(['name' => 'delete projects']);
        Permission::create(['name' => 'create projects']);
        Permission::create(['name' => 'list projects']);


    }
}
