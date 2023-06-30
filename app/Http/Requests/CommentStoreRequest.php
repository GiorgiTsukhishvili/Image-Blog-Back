<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentStoreRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'blog_id' => 'required|integer',
			'comment' => 'required|string',
		];
	}
}
