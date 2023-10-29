<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
	use HasFactory;

	protected $fillable = [
		'user_id',
		'creator_id',
		'type',
		'is_new',
		'blog_id',
	];

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function creator(): BelongsTo
	{
		return $this->belongsTo(User::class, 'creator_id', 'id');
	}

	public function blog(): BelongsTo
	{
		return $this->belongsTo(Blog::class);
	}

	public function make($userId, $creatorId, $type, $blogId)
	{
		$this->create([
			'user_id'    => $userId,
			'creator_id' => $creatorId,
			'type'       => $type,
			'blog_id'    => $blogId,
		]);
	}
}
