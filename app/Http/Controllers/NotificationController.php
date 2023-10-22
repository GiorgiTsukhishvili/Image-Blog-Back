<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificationMarkRequest;
use App\Models\Notification;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
	public function show(): JsonResponse
	{
		$notifications = Notification::where('user_id', auth()->user()->id)->with(['blog:id,name', 'creator:id,name,image'])->get();

		return response()->json($notifications, 201);
	}

	public function markNotification(NotificationMarkRequest $request): JsonResponse
	{
		$notifications = $request->validated();

		foreach ($notifications['ids'] as $id) {
			Notification::where('id', $id)->update(['is_new' => false]);
		}

		return response()->json(['message' => 'notifications marked'], 201);
	}
}
