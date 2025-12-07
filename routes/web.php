<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnakController;
use App\Http\Controllers\DaerahController;
use App\Http\Controllers\DdstItemController;
use App\Http\Controllers\DdstTestController;
use App\Http\Controllers\DdstTestItemController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\SuperadminController;
use App\Models\Antropometri;
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

        Route::get('/dashboard', [AdminController::class, 'dashboardAdmin'])
            ->name('dashboard');

        Route::resource('data-daerah', DaerahController::class)
            ->only(['index'])
            ->names('daerah');

        Route::resource('data-sekolah', SekolahController::class)
            ->names('sekolah');

        Route::resource('data-guru', GuruController::class)
            ->names('guru');

        Route::resource('data-orang-tua', OrangTuaController::class)
            ->names('orang_tua');

        Route::resource('data-anak', AnakController::class)
            ->names('anak');

        Route::resource('data-antropometri', Antropometri::class)
            ->names('antropometri');

        Route::resource('data-ddst-items', DdstItemController::class)
            ->names('ddst_item');

        Route::resource('data-ddst-tests', DdstTestController::class)
            ->names('ddst_test');

        Route::resource('data-ddst-test-items', DdstTestItemController::class)
            ->names('ddst_test_item');
    });

Route::middleware(['auth', 'role:guru'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {
        Route::get('/dashboard', [GuruController::class, 'dashboardGuru'])
            ->name('dashboard');

        Route::resource('data-anak', AnakController::class)
            ->names('anak');
    });

require __DIR__ . '/auth.php';
