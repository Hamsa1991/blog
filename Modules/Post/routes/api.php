<?php

use Illuminate\Support\Facades\Route;
use Modules\Post\Http\Controllers\PostController;
Route::prefix('posts')->group(function () {

    Route::get('/', [PostController::class, 'index'])
        ->name('posts.index');


    Route::get('/{id}', [PostController::class, 'show'])
        ->name('posts.show');

});
