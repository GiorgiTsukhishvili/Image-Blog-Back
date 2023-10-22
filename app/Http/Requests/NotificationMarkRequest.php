<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotificationMarkRequest extends FormRequest
{
	public function authorize(): bool
	{
		return auth()->user()->id === request('user_id');
	}

	public function rules(): array
	{
		return [
			'ids' => 'array|required',
		];
	}
}
