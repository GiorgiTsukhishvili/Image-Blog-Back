<?php

namespace App\Http\Controllers;

use App\Models\Subscribe;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class SubscribeController extends Controller
{
	public function index(): JsonResponse
	{
		Auth::loginUsingId(1);

		$subscribers = Subscribe::where('user_id', auth()->user()->id)
		->with('subscribes:id,name')
		->get(['id', 'subscribed_id']);

		return response()->json(['subscribers' => $subscribers], 200);
	}
}
