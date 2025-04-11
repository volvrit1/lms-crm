<?php

use App\Http\Controllers\admin\status\StatusController;
use App\Http\Controllers\Task\TaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticateMiddleware;



Route::prefix('admin/')->middleware([AuthenticateMiddleware::class])->group(function () {
    Route::resource('task', TaskController::class);
});
