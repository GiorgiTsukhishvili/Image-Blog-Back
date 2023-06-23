<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::controller(BlogController::class)->group(function () {
	Route::get('/', 'index')->name('blog.index');
});
