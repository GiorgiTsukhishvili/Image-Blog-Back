<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscribeOrUnsubscribeRequest;
use App\Models\Notification;
use App\Models\Subscribe;
use Illuminate\Http\JsonResponse;

class SubscribeController extends Controller
{
	public function __construct(private Notification $notification)
	{
	}

	public function index(): JsonResponse
	{
		$subscribers = Subscribe::where('user_id', auth()->user()->id)
		->with('subscribes:id,name,image')
		->get(['id', 'subscribed_id']);

		return response()->json(['subscribers' => $subscribers], 200);
	}

	public function userSubscribers(): JsonResponse
	{
		$subscribers = Subscribe::where('subscribed_id', auth()->user()->id)
		->with('user:id,name,image')
		->get(['id', 'subscribed_id', 'user_id']);

		return response()->json(['subscribers' => $subscribers], 200);
	}

	public function subscribeOrUnsubscribe(SubscribeOrUnsubscribeRequest $request): JsonResponse
	{
		$data = $request->validated();

		$subscriber = Subscribe::firstWhere([['user_id', $data['subscribed_to']], ['subscribed_id', auth()->user()->id]]);

		if (isset($subscriber)) {
			$subscriber->delete();
			return response()->json(['message' => 'Unsubscribed successfully'], 200);
		}

		Subscribe::create(['user_id'=> $data['subscribed_to'], 'subscribed_id' => auth()->user()->id]);

		$this->notification->make($data['subscribed_to'], auth()->user()->id, 'subscribe');

		return response()->json(['message' => 'Subscribed successfully'], 200);
	}
}
