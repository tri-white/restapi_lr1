<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Sportsmans;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sportsmen>
 */
class SportsmenFactory extends Factory
{
    protected $model = Sportsmans::class;

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
            'sponsor'=>null,
        ];
    }

    /**
     * Indicate that the sportsman is sponsored
     */
    public function sponsored(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'sponsor' => fake()->company(),
            ];
        });
    }
}
