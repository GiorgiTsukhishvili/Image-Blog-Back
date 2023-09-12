<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordResetRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserVerificationController extends Controller
{
	public function verify(Request $request): JsonResponse
	{
		if ($request->hasValidSignature(false)) {
			abort(401);
		}

		$user = User::where('verification_token', $request->token)->firstOrFail();

		if ($user->email_verified_at) {
			return response()->json('email is already verified', 422);
		}

		$user->email_verified_at = now();

		$user->save();

		return response()->json(['message' => 'email updated successfully']);
	}

	public function passwordReset(PasswordResetRequest $request): JsonResponse
	{
		if ($request->hasValidSignature(false)) {
			abort(401);
		}

		$user = User::where('verification_token', $request->token)->firstOrFail();

		$user->password = bcrypt($request->password);

		$user->save();

		return response()->json('User password changed successfully', 201);
	}
}
