<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCollection extends Model
{
	use HasFactory;

	protected $fillable = ['name', 'image'];

	public function blog()
	{
		return $this->hasMany(Blog::class);
	}
}
