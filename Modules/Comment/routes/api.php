<?php

use Illuminate\Support\Facades\Route;
use Modules\Comment\Http\Controllers\CommentController;

Route::prefix('posts')->group(function () {
    Route::get('/{postId}/comments', [CommentController::class, 'getPostComments'])
        ->name('posts.comments.index');
});


Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('posts')->group(function () {
        Route::post('/{id}/comments', [CommentController::class, 'store'])
            ->name('posts.comments.store');
    });
});
