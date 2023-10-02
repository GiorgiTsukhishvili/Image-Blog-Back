<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BlogCollection extends Model
{
	use HasFactory;

	protected $fillable = ['name', 'image', 'user_id'];

	public function blogs(): HasMany
	{
		return $this->hasMany(Blog::class);
	}

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}
