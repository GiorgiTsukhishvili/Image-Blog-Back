<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BlogCollectionFactory extends Factory
{
	public function definition(): array
	{
		return [
			'name'    => fake()->name(),
			'image'   => null,
			'user_id' => fake()->numberBetween(1, 10),
		];
	}
}
