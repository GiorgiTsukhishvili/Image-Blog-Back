<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogStoreRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'image'             => 'required|file',
			'title'             => 'required|string',
			'description'       => 'required|string',
			'blog_collection_id'=> 'required|integer',
			'tags'              => 'required',
		];
	}
}
