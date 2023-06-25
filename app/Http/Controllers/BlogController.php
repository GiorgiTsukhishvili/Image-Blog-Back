<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogStoreRequest;
use App\Models\Blog;
use Illuminate\Http\JsonResponse;

class BlogController extends Controller
{
	public function index(): JsonResponse
	{
		$blogs = Blog::with(['user:id,name', 'tags:id,name'])->get()->sortByDesc('created_at');

		return response()->json(['blogs' => $blogs], 200);
	}

	public function show($blog): JsonResponse
	{
		$chosenBlog = Blog::where('id', $blog)->with(['collection:id,name,image', 'tags:id,name'])->first();

		return response()->json($chosenBlog, 200);
	}

	public function store(BlogStoreRequest $request): JsonResponse
	{
	}

	public function put(Blog $blog)
	{
	}

	public function destroy(Blog $blog): JsonResponse
	{
		$blog->delete();

		return response()->json(['message' => 'Blog deleted successfully'], 200);
	}
}
