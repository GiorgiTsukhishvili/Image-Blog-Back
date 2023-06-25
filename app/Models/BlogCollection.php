<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCollection extends Model
{
	use HasFactory;

	protected $fillable = ['name', 'image', 'user_id'];

	public function blogs()
	{
		return $this->hasMany(Blog::class);
	}
}
