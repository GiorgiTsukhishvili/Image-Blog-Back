<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
	public function definition(): array
	{
		return [
			'name'              => fake()->userName(),
			'email'             => fake()->unique()->safeEmail(),
			'email_verified_at' => now(),
			'background_image'  => asset('assets/png/background.jpg'),
			'password'          => '12345678',
			'remember_token'    => Str::random(10),
			'image'             => asset('assets/png/bear.png'),
			'google_id'         => null,
			'description'       => fake()->sentence(200),
		];
	}

	public function unverified(): static
	{
		return $this->state(fn (array $attributes) => [
			'email_verified_at' => null,
		]);
	}
}
