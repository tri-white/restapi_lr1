<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sportsmen>
 */
class SportsmenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>fake()->word(),
            'email'=>fake()->email(),
            'gender'=>fake()->randomElement(['male','female']),
            'category'=>fake()->randomElement([
                'tennis',
                'marathon',
                'spear throwing',
                'athletics',
            ]),
            'sponsor'=>fake()->randomElement([
                fake()->company(),
                null
            ]),
        ];
    }
}
