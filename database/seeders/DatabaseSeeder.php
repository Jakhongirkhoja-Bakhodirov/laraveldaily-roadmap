<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // \App\Models\Post::factory(100)->create();
        // \App\Models\Mechanic::factory(10)->create();
        // \App\Models\Car::factory(100)->create();
        // \App\Models\Owner::factory(100)->create();
        \App\Models\Role::factory(20)->create();
    }
}
