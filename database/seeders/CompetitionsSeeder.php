<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Competitions;
use App\Models\Sportsmans;
class CompetitionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Competitions::factory()->count(40)->create(); // creating competitions without competitors(sportsmen)
        Competitions::factory()->count(20)->trashed()->create(); // creating trashed competitions without competitors(sportsmen)
        Competitions::factory()
            ->count(20)
            ->trashed()
            ->has(Sportsmans::factory()->count(10))
            ->create(); // creating trashed competitions with competitors(sportsmen)
        Competitions::factory()
            ->count(20)
            ->has(Sportsmans::factory()->count(15))
            ->create(); // creating competitions with competitors(sportsmen)

        $sportsmen = Sportsmans::factory()->count(200)->create();

        $competitions = Competitions::factory()->count(20)->create();

        $competitions->each(function ($competition) use ($sportsmen) {
            $competition->sportsmans()->attach($sportsmen->random());
        });
    }
}
