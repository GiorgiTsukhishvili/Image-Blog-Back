<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
	use HasFactory;

	protected $hidden = ['pivot'];

	public function blogs(): BelongsToMany
	{
		return $this->belongsToMany(Blog::class, 'blog_tags');
	}
}
