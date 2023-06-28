<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscribeOrUnsubscribeRequest extends FormRequest
{
	public function authorize()
	{
		return request('user_id') === auth()->user()->id;
	}

	public function rules(): array
	{
		return [
			'user_id'       => 'required|integer',
			'subscribed_id' => 'required|integer',
		];
	}
}
