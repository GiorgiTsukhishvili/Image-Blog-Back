<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::controller(BlogController::class)->group(function () {
	Route::get('/', 'index')->name('blog.index');
	Route::post('/', 'store')->name('blog.store');
	Route::put('/{blog}', 'put')->name('blog.put');
	Route::delete('/{blog}', 'destroy')->name('blog.destroy');
});
