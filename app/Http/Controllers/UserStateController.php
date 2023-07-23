<?php

namespace App\Http\Controllers;

class UserStateController extends Controller
{
	public function login()
	{
	}

	public function logout()
	{
        auth()->guard('web')->logout();
		request()->session()->invalidate();
		request()->session()->regenerateToken();

		return response()->json(['message' => 'User logged out successfully'], 201);
	}
}
