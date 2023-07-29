<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscribeOrUnsubscribeRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'subscribed_to' => 'required|integer',
		];
	}
}
