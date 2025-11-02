<?php

use Illuminate\Support\Facades\Route;

// Auth routes
Route::prefix('auth')->group(base_path('app/Modules/Auth/Routes/api.php'));

// Post routes
Route::prefix('posts')->group(base_path('app/Modules/Post/Routes/api.php'));

// Like routes
Route::prefix('')->group(base_path('app/Modules/Like/Routes/api.php'));

// Comment routes
Route::prefix('')->group(base_path('app/Modules/Comment/Routes/api.php'));
