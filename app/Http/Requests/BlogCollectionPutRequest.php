<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogCollectionPutRequest extends FormRequest
{
	public function authorize(): bool
	{
		$blogCollection = $this->route('collection');

		return $blogCollection->user_id === auth()->user()->id;
	}

	public function rules(): array
	{
		return [
			'name'  => 'required|string',
			'image' => 'nullable',
		];
	}
}
