<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
	public function run(): void
	{
		$tags = config('blogTags');

		foreach ($tags as $tag) {
			Tag::factory()->create(['name' => $tag]);
		}
	}
}
