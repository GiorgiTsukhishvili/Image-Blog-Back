<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Blog extends Model
{
	use HasFactory;

	protected $hidden = ['pivot', 'updated_at'];

	protected $fillable = ['user_id', 'blog_collection_id', 'image', 'title', 'description'];

	public function scopeFilter($query, array $filters)
	{
		if (isset($filters['tags']) && isset($filters['search'])) {
			$tags = explode(',', $filters['tags']);

			return $query->whereHas(
				'tags',
				fn ($query) => $query->whereIn('name', $tags)
			)->where('title', 'like', '%' . $filters['search'] . '%');
		} elseif ($filters['tags'] ?? false) {
			$tags = explode(',', $filters['tags']);

			return $query->whereHas(
				'tags',
				fn ($query) => $query->whereIn('name', $tags)
			);
		} elseif ($filters['search'] ?? false) {
			return $query->where('title', 'like', '%' . $filters['search'] . '%');
		}
	}

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function tags(): BelongsToMany
	{
		return $this->belongsToMany(Tag::class, 'blog_tags');
	}

	public function collection(): BelongsTo
	{
		return $this->belongsTo(BlogCollection::class, 'blog_collection_id', 'id');
	}

	public function likes(): HasMany
	{
		return $this->hasMany(Like::class);
	}

	public function comments(): HasMany
	{
		return $this->hasMany(Comment::class);
	}
}
