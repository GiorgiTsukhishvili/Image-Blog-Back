<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
	use HasFactory;

	protected $hidden = ['pivot'];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function tags()
	{
		return $this->belongsToMany(Tag::class, 'blog_tags');
	}

	public function collection()
	{
		return $this->belongsTo(BlogCollection::class);
	}
}
