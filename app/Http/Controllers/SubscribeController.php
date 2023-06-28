<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscribeOrUnsubscribeRequest;
use App\Models\Subscribe;
use Illuminate\Http\JsonResponse;

class SubscribeController extends Controller
{
	public function index(): JsonResponse
	{
		$subscribers = Subscribe::where('user_id', auth()->user()->id)
		->with('subscribes:id,name,image')
		->get(['id', 'subscribed_id']);

		return response()->json(['subscribers' => $subscribers], 200);
	}

	public function subscribeOrUnsubscribe(SubscribeOrUnsubscribeRequest $request)
	{
		$data = $request->validated();

		$message = '';

		$subscriber = Subscribe::firstWhere([['user_id', auth()->user()->id], ['subscribed_id', $data['subscribed_id']]]);

		if (isset($subscriber)) {
			$subscriber->delete();
			$message = 'Unsubscribed successfully';
		} else {
			Subscribe::create(['user_id' => auth()->user()->id, 'subscribed_id' => $data['subscribed_id']]);
			$message = 'Subscribed successfully';
		}

		return response()->json(['message' => $message], 200);
	}
}
