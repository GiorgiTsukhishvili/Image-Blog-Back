<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogCollectionStoreRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'name'  => 'required|string',
			'image' => 'file',
		];
	}
}
