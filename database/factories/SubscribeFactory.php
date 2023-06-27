<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubscribeFactory extends Factory
{
	public function definition(): array
	{
		return [
			'user_id'       => fake()->numberBetween(1, 10),
			'subscribed_id' => fake()->numberBetween(1, 10),
		];
	}
}
