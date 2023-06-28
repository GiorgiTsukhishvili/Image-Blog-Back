<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LikeOrUnlikeRequest extends FormRequest
{
	public function authorize(): bool
	{
		return auth()->user()->id === request('user_id');
	}

	public function rules(): array
	{
		return [
			'user_id' => 'required|integer',
			'blog_id' => 'required|integer',
		];
	}
}
