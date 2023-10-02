<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscribe extends Model
{
	use HasFactory;

	protected $fillable = ['user_id', 'subscribed_id'];

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function subscribes(): BelongsTo
	{
		return $this->belongsTo(User::class, 'subscribed_id', 'id');
	}
}
