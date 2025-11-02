<?php

use Illuminate\Support\Facades\Route;
use Modules\Like\Http\Controllers\LikeController;


Route::prefix('posts')->group(function () {

    Route::get('/{id}/likes', [LikeController::class, 'getPostLikes'])
        ->name('posts.likes.index');

    Route::middleware('auth:sanctum')->group(function () {
        // Toggle like for a post
        Route::post('/{id}/like', [LikeController::class, 'toggleLike'])
            ->name('posts.like.toggle');

    });
});
