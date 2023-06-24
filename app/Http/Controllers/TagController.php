<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\JsonResponse;

class TagController extends Controller
{
	public function index(): JsonResponse
	{
		$tags = Tag::all('id', 'name');

		return response()->json(['tags' => $tags]);
	}
}
