<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
	public function definition(): array
	{
		return [
			'user_id'            => 1,
			'description'        => fake()->sentence(200),
			'title'              => fake()->text(),
			'image'              => asset('assets/png/bear.png'),
			'blog_collection_id' => fake()->numberBetween(1, 10),
		];
	}
}
