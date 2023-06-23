<?php

namespace App\Http\Controllers;

use App\Models\Blog;

class BlogController extends Controller
{
	public function index()
	{
		return response()->json(['blogs' => Blog::all()]);
	}
}
