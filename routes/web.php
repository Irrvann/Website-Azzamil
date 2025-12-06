<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DaerahController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperadminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome'); 
});

Route::middleware(['auth', 'role:super_admin'])
    ->prefix('superadmin')
    ->name('superadmin.')
    ->group(function () {

        Route::get('/dashboard', [SuperadminController::class, 'index'])
            ->name('dashboard');

        Route::resource('data-daerah', DaerahController::class)
            ->names('daerah');
        Route::resource('data-admin', AdminController::class)
            ->names('admin');
            
    });


Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'index'])
            ->name('dashboard');

        Route::resource('data-daerah', DaerahController::class)
            ->only(['index'])      
            ->names('daerah');     
    });


require __DIR__ . '/auth.php';
