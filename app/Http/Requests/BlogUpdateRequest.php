<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogUpdateRequest extends FormRequest
{
	public function authorize(): bool
	{
		$blog = $this->route('blog');

		return $blog->user_id === auth()->user()->id;
	}

	public function rules(): array
	{
		return [
			'image'             => 'required',
			'title'             => 'required|string',
			'description'       => 'required|string',
			'tags'              => 'required',
		];
	}
}
