<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
	public function store(CommentStoreRequest $request): JsonResponse
	{
		$data = $request->validated();

		Comment::create([
			'user_id' => auth()->user()->id,
			'blog_id' => $data['blog_id'],
			'comment' => $data['comment'],
		]);

		return response()->json(['message' => 'Comment added successfully'], 200);
	}
}
