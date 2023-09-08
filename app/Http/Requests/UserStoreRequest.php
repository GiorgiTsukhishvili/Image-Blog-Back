<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'name'                  => 'required|min:3',
			'email'                 => 'required|email',
			'password'              => 'required|min:8',
			'password_confirmation' => 'confirmed',
		];
	}
}
