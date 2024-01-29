<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sportsmans;
use App\Models\Regulations;
class SportsmenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sportsmans::factory()->count(35)->create(); // create sportsmen
        Sportsmans::factory()->count(35)->sponsored()->create(); // create sponsored sportsmen

                //hasAttached (for many-to-many between sportsman and regulations) 
                    //'completion_date'=>fake()->dateTimeBetween('-5 years', 'now'),
        // ->state() to change fields
        Sportsmans::factory()
            ->count(30)
            ->hasAttached(
                Regulations::factory()->count(3),
                [
                    'completion_date'=>fake()->dateTimeBetween('-5 years', 'now'),
                ]
            )
            ->create();

    }
}
