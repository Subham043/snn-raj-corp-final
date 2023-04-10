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

    }
}
