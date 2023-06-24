<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogCollectionPutRequest extends FormRequest
{
	public function authorize(): bool
	{
		$blogCollectionId = $this->route('collection');

		return $blogCollectionId->user_id === 1;
	}

	public function rules(): array
	{
		return [
			'name' => 'required|string',
		];
	}
}
