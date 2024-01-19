<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Regulations>
 */
class RegulationsFactory extends Factory
{
    protected $model = Regulations::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'name'=>fake()->word(),
           'description'=>fake()->sentence(),
           'minimal_requirements'=>fake()->word(5),
           'gender'=>fake()->randomElement([
                'male',
                'female',
                'unisex',
           ]),
           
        ];
    }
}
