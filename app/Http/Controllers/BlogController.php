<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogDeleteRequest;
use App\Http\Requests\BlogStoreRequest;
use App\Http\Requests\BlogUpdateRequest;
use App\Models\Blog;
use App\Models\BlogTag;
use Illuminate\Http\JsonResponse;

class BlogController extends Controller
{
	public function index(): JsonResponse
	{
		$blogs = Blog::with(['user:id,name,image', 'tags:id,name'])
		->withCount(['comments', 'likes'])->orderByDesc('created_at')
		->filter(request(['search', 'tags']))->paginate(10);

		return response()->json(['blogs' => $blogs], 200);
	}

	public function show($blog): JsonResponse
	{
		$chosenBlog = Blog::where('id', $blog)
		->with(['collection:id,name', 'tags:id,name', 'likes:id,user_id,blog_id',
			'user' => function ($query) {
				return $query->select(['id', 'name', 'image'])->with('subscribers:user_id,subscribed_id');
			},
			'comments' => function ($query) {
				return $query->select('id', 'user_id', 'comment', 'blog_id', 'created_at')->orderByDesc('created_at')->with('user:id,name,image');
			}])->firstOrFail();

		return response()->json($chosenBlog, 200);
	}

	public function store(BlogStoreRequest $request): JsonResponse
	{
		$data = $request->validated();

		if ($request->hasFile('image')) {
			$url = $request->file('image')->store('images', 'public');

			$data['image'] = asset('storage/' . $url);
		}

		$blog = Blog::create([
			'user_id'                      => auth()->user()->id,
			'image'                        => $data['image'],
			'title'                        => $data['title'],
			'description'                  => $data['description'],
			'blog_collection_id'           => $data['blog_collection_id'],
		]);

		$tags = json_decode($request['tags']);

		foreach ($tags as $tag) {
			BlogTag::create([
				'blog_id' => $blog->id,
				'tag_id'  => $tag,
			]);
		}

		return response()->json(['data' => $blog], 200);
	}

	public function put(BlogUpdateRequest $request, Blog $blog): JsonResponse
	{
		$data = $request->validated();

		if ($request->hasFile('image')) {
			$url = $request->file('image')->store('images', 'public');

			$data['image'] = asset('storage/' . $url);
		}

		$blog->update([
			'image'                        => $data['image'],
			'title'                        => $data['title'],
			'description'                  => $data['description'],
		]);

		$tags = json_decode($request['tags']);

		BlogTag::where('blog_id', $blog->id)->delete();

		foreach ($tags as $tag) {
			BlogTag::create([
				'blog_id' => $blog->id,
				'tag_id'  => $tag,
			]);
		}

		return response()->json(['message' => 'Blog updated successfully'], 200);
	}

	public function destroy(BlogDeleteRequest $request, Blog $blog): JsonResponse
	{
		$request->validated();

		$blog->delete();

		return response()->json(['message' => 'Blog deleted successfully'], 200);
	}

	public function showUserBlogs()
	{
		$chosenBlog = Blog::where('user_id', auth()->user()->id)
		->with(['collection:id,name', 'tags:id,name', 'likes:id,user_id,blog_id'])
		->orderByDesc('created_at')->get();

		return response()->json($chosenBlog, 200);
	}
}
