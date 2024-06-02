<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::controller(JobController::class)->group(function () {
    Route::get('/', 'index');
});

//search
Route::get('/search', SearchController::class);

//tag show
Route::get('/tags/{tag:title}', TagController::class);

Route::prefix('jobs')->middleware('auth')
    ->group(function () {
        Route::get('/', [JobController::class, 'create'])->name('jobs.create');
        Route::post('/', [JobController::class, 'store'])->name('jobs.store');
    });


//register and login
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterUserController::class, 'create']);
    Route::post('/register', [RegisterUserController::class, 'store']);

    Route::get('/login', [SessionController::class, 'create']);
    Route::post('/login', [SessionController::class, 'store']);
});

//logout
Route::delete('/logout', [SessionController::class, 'destroy'])->middleware('auth');
