<?php

use App\Http\Controllers\BlogCollectionController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::controller(BlogController::class)->group(function () {
	Route::prefix('blogs')->group(function () {
		Route::get('/', 'index')->name('blog.index');
		Route::get('/{blog}', 'show')->name('blog.show');
		Route::post('/', 'store')->name('blog.store');
		Route::put('/{blog}', 'put')->name('blog.put');
		Route::delete('/{blog}', 'destroy')->name('blog.destroy');
	});
});

Route::controller(TagController::class)->group(function () {
	Route::get('/tags', 'index')->name('tag.index');
});

Route::controller(BlogCollectionController::class)->group(function () {
	Route::prefix('collection')->group(function () {
		Route::get('/', 'index')->name('collection.index');
	});
});
