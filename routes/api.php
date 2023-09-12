<?php

use App\Http\Controllers\BlogCollectionController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserStateController;
use App\Http\Controllers\UserVerificationController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {
	Route::controller(UserVerificationController::class)->group(function () {
		Route::get('/verify-email', 'verify')->name('user.verify');
		Route::post('/password-reset', 'passwordReset')->name('user.password_reset');
	});

	Route::controller(UserController::class)->group(function () {
		Route::get('/{name}', 'show')->name('user.show');
		Route::post('/', 'store')->name('user.store');
		Route::post('/password-email', 'passwordEmail')->name('user.password_email');
		Route::post('/password-user', 'passwordUser')->name('user.password_user');
		Route::put('/{id}', 'put')->name('user.put');
	});
});

Route::controller(UserStateController::class)->group(function () {
	Route::prefix('user-state')->group(function () {
		Route::post('/login', 'login')->name('user_state.login');
		Route::middleware('auth:sanctum')->group(function () {
			Route::get('/logout', 'logout')->name('user_state.logout');
			Route::get('/user-info', 'userInfo')->name('user_state.user_info');
		});
	});
});

Route::controller(BlogController::class)->group(function () {
	Route::prefix('blog')->group(function () {
		Route::get('/', 'index')->name('blog.index');
		Route::get('/{blog}', 'show')->name('blog.show');
		Route::middleware('auth:sanctum')->group(function () {
			Route::post('/', 'store')->name('blog.store');
			Route::put('/{blog}', 'put')->name('blog.put');
			Route::delete('/{blog}', 'destroy')->name('blog.destroy');
			Route::get('/user/blogs', 'showUserBlogs')->name('blog.show_user_blogs');
		});
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
		Route::get('/{user:name}', 'show')->name('collection.show');
		Route::middleware('auth:sanctum')->group(function () {
			Route::post('/', 'store')->name('collection.store');
			Route::put('/{collection}', 'put')->name('collection.put');
			Route::delete('/{collection}', 'destroy')->name('collection.destroy');
			Route::get('/user/collections', 'showUserCollections')->name('collection.show_user_collections');
		});
	});
});

Route::controller(SubscribeController::class)->group(function () {
	Route::prefix('subscribe')->group(function () {
		Route::middleware('auth:sanctum')->group(function () {
			Route::post('/', 'subscribeOrUnsubscribe')->name('subscribe.subscribe_or_unsubscribe');
			Route::get('/', 'index')->name('subscribe.index');
			Route::get('/subscribers', 'userSubscribers')->name('subscribe.user_subscribers');
		});
	});
});

Route::controller(LikeController::class)->group(function () {
	Route::prefix('like')->group(function () {
		Route::get('/', 'index')->name('like.index');
		Route::middleware('auth:sanctum')->group(function () {
			Route::post('/', 'likeOrUnlike')->name('like.like_or_unlike');
		});
	});
});

Route::controller(CommentController::class)->group(function () {
	Route::prefix('/comment')->group(function () {
		Route::middleware('auth:sanctum')->group(function () {
			Route::post('/', 'store')->name('comment.store');
		});
	});
});
