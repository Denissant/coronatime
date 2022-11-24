<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Statistics>
 */
class StatisticsFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition()
	{
		return [
			'confirmed' => $this->faker->numberBetween(0, 5000),
			'recovered' => $this->faker->numberBetween(0, 5000),
			'deaths'    => $this->faker->numberBetween(0, 5000),
		];
	}
}
