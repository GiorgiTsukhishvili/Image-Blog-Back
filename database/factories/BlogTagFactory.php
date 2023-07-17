<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BlogTagFactory extends Factory
{
	public function definition(): array
	{
		return [
			'blog_id' => fake()->numberBetween(1, 30),
			'tag_id'  => fake()->numberBetween(1, 10),
		];
	}
}
