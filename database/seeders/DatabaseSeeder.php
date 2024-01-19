<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //create trashed competitions with ->trashed()->create()
        //create ->sponsored() sportsmen
            //'completion_date'=>fake()->dateTimeBetween('-5 years', 'now'),
        //hasAttached (for many-to-many between sportsman and regulations) 
        //has() for hasMany
        //for() for belongsTo
        // ->state() to change fields
    }
}
