<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
	use HasFactory;

	protected $hidden = ['pivot', 'updated_at'];

	protected $fillable = ['user_id', 'blog_collection_id', 'image', 'title', 'description'];

	public function scopeFilter($query, array $filters)
	{
		if ($filters['search'] ?? false) {
			return $query->where('title', 'like', '%' . $filters['search'] . '%');
		}
	}

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
		return $this->belongsTo(BlogCollection::class, 'blog_collection_id', 'id');
	}

	public function likes()
	{
		return $this->hasMany(Like::class);
	}

	public function comments()
	{
		return $this->hasMany(Comment::class);
	}
}
