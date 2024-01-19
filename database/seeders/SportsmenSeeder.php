<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sportsmen;
class SportsmenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sportsmen::factory()->count(35)->create(); // create sportsmen
        Sportsmen::factory()->count(35)->sponsored()->create(); // create sponsored sportsmen
    }
}
