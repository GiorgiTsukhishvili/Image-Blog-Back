<?php

namespace App\Http\Controllers;

use App\Http\Requests\LikeOrUnlikeRequest;
use App\Models\Like;
use App\Models\Notification;
use Illuminate\Http\JsonResponse;

class LikeController extends Controller
{
	public function __construct(private Notification $notification)
	{
	}

	public function index(): JsonResponse
	{
		$likes = Like::select(['id', 'blog_id'])
		->where('user_id', auth()->user()->id)
		->with('blog:id,image,title,description')
		->get();

		return response()->json(['likes' => $likes], 200);
	}

	public function likeOrUnlike(LikeOrUnlikeRequest $request): JsonResponse
	{
		$data = $request->validated();

		$like = Like::firstWhere([['user_id', auth()->user()->id], ['blog_id', $data['blog_id']]]);

		if (isset($like)) {
			$like->delete();
			return response()->json(['message' => 'Blog like removed successfully'], 200);
		}

		Like::create(['user_id' => auth()->user()->id, 'blog_id' => $data['blog_id']]);
		return response()->json(['message' => 'Blog liked successfully'], 200);
	}
}
