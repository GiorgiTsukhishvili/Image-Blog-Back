<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\JsonResponse;

class BlogController extends Controller
{
	public function index(): JsonResponse
	{
		$blogs = Blog::with('user')->get();

		return response()->json(['blogs' => $blogs]);
	}

	public function store()
	{
	}

	public function put(Blog $blog)
	{
	}

	public function destroy(Blog $blog): JsonResponse
	{
		$blog->delete();

		return response()->json(['message' => 'Blog deleted successfully']);
	}
}
