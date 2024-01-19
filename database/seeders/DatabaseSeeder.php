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

        //hasAttached (for many-to-many between sportsman and regulations) 
                    //'completion_date'=>fake()->dateTimeBetween('-5 years', 'now'),
        //has() for hasMany
        //for() for belongsTo
        // ->state() to change fields

        $this->call([
            CompetitionsSeeder::class,
            SportsmenSeeder::class,
            RegulationsSeeder::class,
        ]);
    }
}
