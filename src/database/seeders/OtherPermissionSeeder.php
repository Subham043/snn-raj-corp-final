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

        //permission for awards
        Permission::create(['name' => 'edit awards']);
        Permission::create(['name' => 'delete awards']);
        Permission::create(['name' => 'create awards']);
        Permission::create(['name' => 'list awards']);

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

    }
}
