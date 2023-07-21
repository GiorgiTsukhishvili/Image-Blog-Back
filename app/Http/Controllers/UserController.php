<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
	public function show($name): JsonResponse
	{
		$user = User::where('name', $name)
		->select(['id', 'name', 'image', 'background_image', 'description'])
		->withCount(['subscribers', 'blogs'])
		->with(['collections' => function ($query) {
			return $query->select(['id', 'user_id', 'image', 'name'])->withCount('blogs');
		}])->firstOrFail();

		return response()->json($user, 200);
	}
}
