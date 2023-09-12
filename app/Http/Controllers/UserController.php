<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordEmailRequest;
use App\Http\Requests\PasswordUserRequest;
use App\Http\Requests\UserPutRequest;
use App\Http\Requests\UserStoreRequest;
use App\Mail\PasswordResetEmail;
use App\Mail\UserRegistrationEmail;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

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

	public function store(UserStoreRequest $request): JsonResponse
	{
		$data = $request->validated();

		$token = sha1(time());

		$user = User::create([
			'name'               => $data['name'],
			'email'              => $data['email'],
			'password'           => bcrypt($data['password']),
			'image'              => asset('assets/png/bear.png'),
			'verification_token' => $token,
		]);

		$route = URL::temporarySignedRoute(
			'user.verify',
			now()->addMinutes(30),
			['token' => $token],
		);

		$frontUrl = config('app.front-url') . '?type=register&register-link=' . $route;

		Mail::to($user->email)->send(new UserRegistrationEmail($frontUrl, $user->name));

		return response()->json(['message' => 'User created successfully'], 201);
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

	public function passwordEmail(PasswordEmailRequest $request): JsonResponse
	{
		$user = User::where('email', $request->email)->firstOrFail();

		if (!isset($user->email_verified_at)) {
			return response()->json(['message' => 'email is not verified'], 404);
		}

		$token = sha1(time());

		$user->verification_token = $token;

		$user->save();

		$route = URL::temporarySignedRoute(
			'user.password_reset',
			now()->addMinutes(30),
			['token' => $token],
		);

		$frontUrl = config('app.front-url') . '?type=reset&reset-link=' . $route;

		Mail::to($user->email)->send(new PasswordResetEmail($frontUrl, $user->name));

		return response()->json(['message' => 'email sent successfully'], 200);
	}

	public function passwordUser(PasswordUserRequest $request): JsonResponse
	{
		$data = $request->validated();

		$user = User::firstWhere('id', auth()->user()->id);

		if (!Hash::check($data['current_password'], $user->password)) {
			return response()->json(['message' => 'current password is incorrect'], 403);
		}

		$user->password = bcrypt($data['new_password']);

		$user->save();

		return response()->json(['message' => 'password changed successfully'], 201);
	}
}
