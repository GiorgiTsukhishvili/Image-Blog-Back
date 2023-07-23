<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'name'     => 'required|min:3',
			'password' => 'required|min:8',
		];
	}
}
