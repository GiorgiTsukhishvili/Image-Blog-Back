<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogDeleteRequest extends FormRequest
{
	public function authorize(): bool
	{
		$blog = $this->route('blog');

		return $blog->user_id === auth()->user()->id;
	}

	public function rules(): array
	{
		return [
		];
	}
}
