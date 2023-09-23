<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordEmailRequest;
use App\Http\Requests\UpdateEmailRequest;
use App\Mail\PasswordResetEmail;
use App\Mail\UpdateMailEmail;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class UserEmailsController extends Controller
{
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

	public function updateEmail(UpdateEmailRequest $request): JsonResponse
	{
		$data = $request->validated();

		$exists = User::firstWhere('email', $data['email']);

		if (isset($exists)) {
			abort(403, 'Email is already in use');
		}

		$token = sha1(time());

		$user = User::firstWhere('id', auth()->user()->id);

		$user->verification_token = $token;

		$user->save();

		$route = URL::temporarySignedRoute(
			'user.change_email',
			now()->addMinutes(30),
			['token' => $token],
		);

		$frontUrl = config('app.front-url') . 'settings?type=email&email-link=' . $route . '&email=' . $data['email'];

		Mail::to($data['email'])->send(new UpdateMailEmail($frontUrl, $user->name));

		return response()->json(['message' => 'Update email was sent'], 200);
	}

	public function changeEmail(UpdateEmailRequest $request): JsonResponse
	{
		if ($request->hasValidSignature(false)) {
			abort(401);
		}

		$data = $request->validated();

		$user = User::firstWhere('id', auth()->user()->id);

		$user->email = $data['email'];

		$user->save();

		return response()->json(['email' => $data['email']], 201);
	}
}
