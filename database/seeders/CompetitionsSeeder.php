<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Competitions;
class CompetitionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Competitions::factory()->count(40)->create(); // creating just factories without competitors(sportsmen)
        Competitions::factory()->count(20)->trashed()->create(); // creating trashed factories without competitors(sportsmen)
    }
}
