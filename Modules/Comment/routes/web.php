<?php

use Illuminate\Support\Facades\Route;
use Modules\Comment\Http\Controllers\CommentController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('comments', CommentController::class)->names('comment');
});
