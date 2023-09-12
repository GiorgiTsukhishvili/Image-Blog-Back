<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordUserRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'current_password'          => 'required|min:8',
			'new_password'              => 'required|min:8',
			'new_password_confirmation' => 'required|min:8|same:new_password',
		];
	}
}
