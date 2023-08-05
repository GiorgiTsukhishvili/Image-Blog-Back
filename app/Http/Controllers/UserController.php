<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPutRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
	public function show($name): JsonResponse
	{
		$user = User::where('name', $name)
		->select(['id', 'name', 'image', 'background_image', 'description'])
		->withCount('blogs')
		->with(['collections' => function ($query) {
			return $query->select(['id', 'user_id', 'image', 'name'])->withCount('blogs');
		}, 'subscribers'])->firstOrFail();

		return response()->json($user, 200);
	}

	public function put($id, UserPutRequest $request): JsonResponse
	{
		$data = $request->validated();

		$user = User::firstWhere('id', $id);

		if (isset($user)) {
			if ($request->hasFile('image')) {
				$image['image'] = $request->file('image')
				->store('images', 'public');

				$user->image = asset('storage/' . $image['image']);
			}

			if ($request->hasFile('background_image')) {
				$backgroundImage['background_image'] = $request->file('background_image')
				->store('images', 'public');

				$user->background_image = asset('storage/' . $backgroundImage['background_image']);
			}

			$user->name = $data['name'];

			$user->description = $data['description'];

			$user->save();

			return response()->json($user, 201);
		}

		return response()->json(['message' => 'User not found', 401]);
	}
}
