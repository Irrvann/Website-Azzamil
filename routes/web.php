<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnakController;
use App\Http\Controllers\AntropometriController;
use App\Http\Controllers\DaerahController;
use App\Http\Controllers\DdstItemController;
use App\Http\Controllers\DdstTestController;
use App\Http\Controllers\DdstTestItemController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RaportController;
use App\Http\Controllers\ReviewerController;
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

        Route::resource('data-sekolah', SekolahController::class)
            ->names('sekolah');


        Route::resource('data-guru', GuruController::class)
            ->names('guru');

        Route::resource('data-orang-tua', OrangTuaController::class)
            ->names('orang_tua');

        Route::resource('data-anak', AnakController::class)
            ->names('anak');


        Route::resource('data-raport', RaportController::class)
            ->names('raport');

        Route::get('raport/{id}/cetak-pdf', [RaportController::class, 'cetakPdf'])
            ->name('raport.cetak-pdf');

        // Modul tumbuh kembang = antropometri
        Route::resource('data-tumbuh-kembang', AntropometriController::class)
            ->names('data-tumbuh-kembang');

        Route::delete('/antropometri/{antropometri}', [AntropometriController::class, 'destroy'])
            ->name('antropometri.destroy');

        // Tambahan khusus: buat DDST dari satu data antropometri
        Route::get('antropometri/{antropometri}/ddst', [DdstTestController::class, 'createFromAntropometri'])
            ->name('ddst.create_from_antropometri');

        Route::post('antropometri/{antropometri}/ddst', [DdstTestController::class, 'storeFromAntropometri'])
            ->name('ddst.store_from_antropometri');

        Route::get('antropometri/{antropometri}/ddst/cetak', [DdstTestController::class, 'cetakLaporan'])
            ->name('ddst.cetak_laporan');

        Route::resource('data-reviewer', ReviewerController::class)
            ->names('reviewer');

        Route::get('/ajax/sekolah/{sekolah}/anak-guru', [RaportController::class, 'getAnakGuru'])
            ->name('ajax.sekolah.anak-guru');

        Route::get('/ajax/sekolah/{sekolah}/anak', [AntropometriController::class, 'ajaxAnakBySekolah'])
            ->name('ajax.sekolah.anak');
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

        // Tumbuh Kembang
    
        // Modul tumbuh kembang = antropometri
        Route::resource('data-tumbuh-kembang', AntropometriController::class)
            ->names('data-tumbuh-kembang');

        Route::delete('/antropometri/{antropometri}', [AntropometriController::class, 'destroy'])
            ->name('antropometri.destroy');

        // Tambahan khusus: buat DDST dari satu data antropometri
        Route::get('antropometri/{antropometri}/ddst', [DdstTestController::class, 'createFromAntropometri'])
            ->name('ddst.create_from_antropometri');

        Route::post('antropometri/{antropometri}/ddst', [DdstTestController::class, 'storeFromAntropometri'])
            ->name('ddst.store_from_antropometri');

        Route::get('antropometri/{antropometri}/ddst/cetak', [DdstTestController::class, 'cetakLaporan'])
            ->name('ddst.cetak_laporan');



        Route::resource('data-raport', RaportController::class)
            ->names('raport');

        Route::get('raport/{id}/cetak-pdf', [RaportController::class, 'cetakPdf'])
            ->name('raport.cetak-pdf');

        Route::get('/ajax/sekolah/{sekolah}/anak-guru', [RaportController::class, 'getAnakGuru'])
            ->name('ajax.sekolah.anak-guru');

        Route::get('/ajax/sekolah/{sekolah}/anak', [AntropometriController::class, 'ajaxAnakBySekolah'])
            ->name('ajax.sekolah.anak');
    });

Route::middleware(['auth', 'role:guru'])
    ->prefix('guru')
    ->name('guru.')
    ->group(function () {
        Route::get('/dashboard', [GuruController::class, 'dashboardGuru'])
            ->name('dashboard');

        Route::resource('data-anak', AnakController::class)
            ->names('anak');

        // Modul tumbuh kembang = antropometri
        Route::resource('data-tumbuh-kembang', AntropometriController::class)
            ->names('data-tumbuh-kembang');

        // Tambahan khusus: buat DDST dari satu data antropometri
        Route::get('antropometri/{antropometri}/ddst', [DdstTestController::class, 'createFromAntropometri'])
            ->name('ddst.create_from_antropometri');

        Route::post('antropometri/{antropometri}/ddst', [DdstTestController::class, 'storeFromAntropometri'])
            ->name('ddst.store_from_antropometri');

        Route::get('antropometri/{antropometri}/ddst/cetak', [DdstTestController::class, 'cetakLaporan'])
            ->name('ddst.cetak_laporan');

        Route::resource('data-raport', RaportController::class)
            ->names('raport');

        Route::get('raport/{id}/cetak-pdf', [RaportController::class, 'cetakPdf'])
            ->name('raport.cetak-pdf');

        // routes/web.php
        Route::get('/ajax/sekolah/{sekolah}/anak-guru', [RaportController::class, 'getAnakGuru'])
            ->name('ajax.sekolah.anak-guru');

        Route::get('/ajax/sekolah/{sekolah}/anak', [AntropometriController::class, 'ajaxAnakBySekolah'])
            ->name('ajax.sekolah.anak');


    });


Route::middleware(['auth', 'role:orang_tua'])
    ->prefix('orang_tua')
    ->name('orang_tua.')
    ->group(function () {
        Route::get('/dashboard', [OrangTuaController::class, 'dashboardOrangTua'])
            ->name('dashboard');

        Route::resource('data-anak', AnakController::class)
            ->names('anak');

        Route::resource('data-tumbuh-kembang', AntropometriController::class)
            ->names('data-tumbuh-kembang');

        Route::put('/ddst-tests/{ddstTest}/profile', [DdstTestController::class, 'updateProfile'])
            ->name('ddst_tests.update_profile');

        Route::get('antropometri/{antropometri}/ddst', [DdstTestController::class, 'createFromAntropometri'])
            ->name('ddst.create_from_antropometri');

        Route::get('antropometri/{antropometri}/ddst/cetak', [DdstTestController::class, 'cetakLaporan'])
            ->name('ddst.cetak_laporan');

        Route::resource('data-raport', RaportController::class)
            ->names('raport');

        Route::get('raport/{id}/cetak-pdf', [RaportController::class, 'cetakPdf'])
            ->name('raport.cetak-pdf');

        Route::put('/raport/{id}/refleksi-ortu', [RaportController::class, 'updateRefleksiOrtu'])
            ->name('raport.update-refleksi-ortu');

        Route::get('/profile', [OrangTuaController::class, 'profileOrangTua'])
            ->name('profile');

        Route::put('/profile', [OrangTuaController::class, 'updateProfile'])->name('profile.update');

        Route::put('/profile/password', [OrangTuaController::class, 'updatePassword'])->name('profile.password');
    });

require __DIR__ . '/auth.php';
