<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogCollectionDestroyRequest;
use App\Http\Requests\BlogCollectionPutRequest;
use App\Http\Requests\BlogCollectionStoreRequest;
use App\Models\BlogCollection;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class BlogCollectionController extends Controller
{
	public function index(): JsonResponse
	{
		$collections = BlogCollection::withCount('blog')->get();

		return response()->json(['collections' => $collections], 200);
	}

	public function show(User $user)
	{
		$id = request('collection');

		$desiredCollection = BlogCollection::where([['user_id', $user->id], ['id', $id]])
							->with(['user' => function ($query) {
								return $query->select(['id', 'name', 'image'])->withCount(['subscribers', 'blogs']);
							}, 'blogs:id,blog_collection_id,image,title'])
							->firstOrFail();

		return response()->json($desiredCollection, 200);
	}

	public function store(BlogCollectionStoreRequest $request): JsonResponse
	{
		$data = $request->validated();

		if ($request->hasFile('image')) {
			$url = $request->file('image')
			->store('images', 'public');

			$data['image'] = asset('storage/' . $url);
		} else {
			$data['image'] = null;
		}

		BlogCollection::create(['user_id'=> auth()->user()->id, 'name' => $data['name'], 'image' => $data['image']]);

		return response()->json(['message' => 'Collection created successfully'], 200);
	}

	public function put(BlogCollectionPutRequest $request, BlogCollection $collection)
	{
		$data = $request->validated();

		if ($request->hasFile('image')) {
			$url = $request->file('image')->store('images', 'public');

			$data['image'] = asset('storage/', $url);
		} else {
			$data['image'] = null;
		}

		$collection->update(['name' => $data['name'], 'image' => $data['image']]);
		return response()->json(['message' => 'Collection updated successfully'], 200);
	}

	public function destroy(BlogCollectionDestroyRequest $request, BlogCollection $collection): JsonResponse
	{
		$request->validated();

		$collection->delete();

		return response()->json(['message' => 'Collection deleted successfully'], 200);
	}
}
