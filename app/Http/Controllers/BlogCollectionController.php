<?php

namespace App\Http\Controllers;

use App\Models\BlogCollection;
use Illuminate\Http\JsonResponse;

class BlogCollectionController extends Controller
{
	public function index(): JsonResponse
	{
		$collections = BlogCollection::withCount('blog')->get();

		return response()->json(['collections' => $collections]);
	}
}
