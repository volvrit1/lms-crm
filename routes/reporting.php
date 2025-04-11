<?php


use App\Http\Controllers\admin\reporting\ReportingController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticateMiddleware;

// Route group with middleware and prefix
Route::prefix('admin/reporting')->middleware([AuthenticateMiddleware::class])->group(function () {
    Route::get('/', [ReportingController::class, 'index'])->name('reporting.all');
    Route::get('/create', [ReportingController::class, 'create'])->name('reporting.create');
});


?>