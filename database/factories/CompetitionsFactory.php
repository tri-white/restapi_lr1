<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Competitions;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Competitions>
 */
class CompetitionsFactory extends Factory
{
    protected $model = Competitions::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>fake()->word(),
            'event_date'=>fake()->dateTime(),
            'event_location'=>fake()->address(),
            'prize_pool'=>fake()->numberBetween(10000,1000000),
            'sports_type'=>fake()->randomElement([
                '100m sprint',
                '3km run',
                'spear throwing',
                'football',
                'tennis',
            ]),
        ];
    }
}
