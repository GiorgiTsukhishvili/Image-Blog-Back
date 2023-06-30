<?php

use App\Http\Controllers\BlogCollectionController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::controller(BlogController::class)->group(function () {
	Route::prefix('blog')->group(function () {
		Route::get('/', 'index')->name('blog.index');
		Route::get('/{blog}', 'show')->name('blog.show');
		Route::post('/', 'store')->name('blog.store');
		Route::put('/{blog}', 'put')->name('blog.put');
		Route::delete('/{blog}', 'destroy')->name('blog.destroy');
	});
});

Route::controller(TagController::class)->group(function () {
	Route::prefix('tags')->group(function () {
		Route::get('/', 'index')->name('tag.index');
	});
});

Route::controller(BlogCollectionController::class)->group(function () {
	Route::prefix('collection')->group(function () {
		Route::get('/', 'index')->name('collection.index');
		Route::get('/{collection}', 'show')->name('collection.show');
		Route::post('/', 'store')->name('collection.store');
		Route::put('/{collection}', 'put')->name('collection.put');
		Route::delete('/{collection}', 'destroy')->name('collection.destroy');
	});
});

Route::controller(SubscribeController::class)->group(function () {
	Route::prefix('subscribe')->group(function () {
		Route::get('/', 'index')->name('subscribe.index');
		Route::post('/', 'subscribeOrUnsubscribe')->name('subscribe.subscribe_or_unsubscribe');
	});
});

Route::controller(LikeController::class)->group(function () {
	Route::prefix('like')->group(function () {
		Route::get('/', 'index')->name('like.index');
		Route::post('/', 'likeOrUnlike')->name('like.like_or_unlike');
	});
});

Route::controller(CommentController::class)->group(function () {
	Route::prefix('/comment')->group(function () {
		Route::post('/', 'store')->name('comment.store');
	});
});
