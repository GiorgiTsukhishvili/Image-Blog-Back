<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'name'                  => 'required|min:3|unique:users,name',
			'email'                 => 'required|email|unique:users,email',
			'password'              => 'required|min:8',
			'password_confirmation' => 'required|same:password',
		];
	}
}
