<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
	public function definition(): array
	{
		return [
			'user_id' => fake()->numberBetween(1, 10),
			'blog_id' => fake()->numberBetween(1, 30),
		];
	}
}
