<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogCollectionStoreRequest;
use App\Models\BlogCollection;
use Illuminate\Http\JsonResponse;

class BlogCollectionController extends Controller
{
	public function index(): JsonResponse
	{
		$collections = BlogCollection::withCount('blog')->get();

		return response()->json(['collections' => $collections], 200);
	}

	public function show(BlogCollection $collection): JsonResponse
	{
		return response()->json($collection, 200);
	}

	public function store(BlogCollectionStoreRequest $request): JsonResponse
	{
		$data = $request->validated();

		if ($request->hasFile('image')) {
			$text['image'] = $request->file('image')
			->store('images', 'public');

			$data['image'] = asset('storage/' . $text['image']);
		} else {
			$data['image'] = null;
		}

		BlogCollection::create(['user_id'=> auth()->user()->id, 'name' => $data['name'], 'image' => $data['image']]);

		return response()->json(['message' => 'Collection created successfully'], 200);
	}

	public function put(BlogCollection $collection)
	{
	}

	public function destroy(BlogCollection $collection): JsonResponse
	{
		$collection->delete();

		return response()->json(['message' => 'Blog deleted successfully'], 200);
	}
}
