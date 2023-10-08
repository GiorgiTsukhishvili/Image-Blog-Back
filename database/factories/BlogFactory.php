<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
	public function definition(): array
	{
		return [
			'user_id'            => fake()->numberBetween(1, 10),
			'description'        => fake()->sentence(200),
			'title'              => fake()->text(),
			'image'              => asset('assets/png/bear.png'),
			'blog_collection_id' => fake()->numberBetween(1, 10),
			'view'               => fake()->numberBetween(0, 100),
		];
	}
}
