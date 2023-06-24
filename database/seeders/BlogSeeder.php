<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogCollection;
use App\Models\BlogTag;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
	public function run(): void
	{
		BlogCollection::factory(10)->create();

		Blog::factory(10)->create();

		BlogTag::factory(10)->create();

	}
}
