<?php

use Illuminate\Support\Facades\Route;
use Modules\Like\Http\Controllers\LikeController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('likes', LikeController::class)->names('like');
});
