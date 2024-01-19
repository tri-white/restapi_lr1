<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sportsmen;
use App\Models\Regulations;
class SportsmenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sportsmen::factory()->count(35)->create(); // create sportsmen
        Sportsmen::factory()->count(35)->sponsored()->create(); // create sponsored sportsmen

                //hasAttached (for many-to-many between sportsman and regulations) 
                    //'completion_date'=>fake()->dateTimeBetween('-5 years', 'now'),
        // ->state() to change fields
        Sportsmen::factory()
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
