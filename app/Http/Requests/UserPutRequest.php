<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPutRequest extends FormRequest
{
	public function authorize(): bool
	{
		$id = $this->route('id');

		return auth()->user()->id == $id;
	}

	public function rules(): array
	{
		return [
			'name'             => 'required|min:3',
			'description'      => 'required|min:3',
			'image'            => 'required',
			'background_image' => 'required',
		];
	}
}
