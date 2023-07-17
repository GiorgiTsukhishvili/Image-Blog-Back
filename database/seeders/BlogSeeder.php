<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogCollection;
use App\Models\BlogTag;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Subscribe;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
	public function run(): void
	{
		BlogCollection::factory(10)->create();

		Blog::factory(30)->create();

		BlogTag::factory(60)->create();

		Subscribe::factory(30)->create();

		Like::factory(100)->create();

		Comment::factory(100)->create();
	}
}
