<?php

namespace App\Http\Controllers;

use App\Models\BlogCollection;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;

class TagController extends Controller
{
	public function index(): JsonResponse
	{
		$tags = Tag::all('id', 'name');

		$collections = BlogCollection::where('user_id', auth()->user()->id)->get(['id', 'name']);

		return response()->json(['tags' => $tags, 'collections' => $collections]);
	}
}
