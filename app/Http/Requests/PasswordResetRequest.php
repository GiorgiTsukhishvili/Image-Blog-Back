<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'password'              => 'required|min:8',
			'password_confirmation' => 'required|same:password',
		];
	}
}
