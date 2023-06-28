<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\JsonResponse;

class LikeController extends Controller
{
	public function index(): JsonResponse
	{
		$likes = Like::select(['id', 'blog_id'])
		->where('user_id', auth()->user()->id)
		->with('blog:id,image,title,description')
		->get();

		return response()->json(['likes' => $likes], 200);
	}
}
