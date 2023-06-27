<?php

namespace App\Http\Controllers;

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
}
