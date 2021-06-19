<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Admin\DashboardController as Dashboard;

use App\Http\Controllers\Admin\UserController as User;
use App\Http\Controllers\Admin\PoliController as Poli;
use App\Http\Controllers\Admin\DokterController as Dokter;
use App\Http\Controllers\Admin\PasienController as Pasien;
use App\Http\Controllers\Admin\JadwalController as Jadwal;
use App\Http\Controllers\Admin\ReservasiController as Reservasi;
use App\Http\Controllers\Admin\PemeriksaanController as Pemeriksaan;
use App\Http\Controllers\Admin\PengaturanController as Pengaturan;
use App\Http\Controllers\Admin\InformasiController as Informasi;
use App\Http\Controllers\Admin\PasswordController as Password;

use App\Http\Controllers\Admin\TesController;
use App\Http\Controllers\FirebaseController;

Route::get('/', function () {
    return redirect('login');
});

Route::get('/tes', [FirebaseController::class, 'index']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix' => '', 'middleware' => ['auth']], function () {

    Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');



    Route::group(['prefix' => '/user'], function () {
        Route::get('/', [User::class, 'index'])->name('user');
        Route::get('/data', [User::class, 'show'])->name('user.data');
        Route::post('/store', [User::class, 'store'])->name('user.store');
        Route::get('/edit/{id}', [User::class, 'edit'])->name('user.edit');
        Route::post('/update', [User::class, 'update'])->name('user.update');
        Route::get('/delete/{id}', [User::class, 'destroy'])->name('user.delete');
    });

    Route::group(['prefix' => '/poli'], function () {
        Route::get('/', [Poli::class, 'index'])->name('poli');
        Route::get('/data', [Poli::class, 'show'])->name('poli.data');
        Route::post('/store', [Poli::class, 'store'])->name('poli.store');
        Route::get('/edit/{id}', [Poli::class, 'edit'])->name('poli.edit');
        Route::post('/update', [Poli::class, 'update'])->name('poli.update');
        Route::get('/delete/{id}', [Poli::class, 'destroy'])->name('poli.delete');
    });

    Route::group(['prefix' => '/dokter'], function () {
        Route::get('/', [Dokter::class, 'index'])->name('dokter');
        Route::get('/data', [Dokter::class, 'show'])->name('dokter.data');
        Route::post('/store', [Dokter::class, 'store'])->name('dokter.store');
        Route::get('/edit/{id}', [Dokter::class, 'edit'])->name('dokter.edit');
        Route::post('/update', [Dokter::class, 'update'])->name('dokter.update');
        Route::get('/delete/{id}', [Dokter::class, 'destroy'])->name('dokter.delete');
        Route::get('/aktif/{id}', [Dokter::class, 'aktif'])->name('dokter.aktif');
        Route::get('/nonaktif/{id}', [Dokter::class, 'nonaktif'])->name('dokter.nonaktif');
    });

    Route::group(['prefix' => '/pasien'], function () {
        Route::get('/', [Pasien::class, 'index'])->name('pasien');
        Route::get('/data', [Pasien::class, 'show'])->name('pasien.data');
        Route::post('/store', [Pasien::class, 'store'])->name('pasien.store');
        Route::get('/edit/{id}', [Pasien::class, 'edit'])->name('pasien.edit');
        Route::post('/update', [Pasien::class, 'update'])->name('pasien.update');
        Route::get('/delete/{id}', [Pasien::class, 'destroy'])->name('pasien.delete');
    });

    Route::group(['prefix' => '/jadwal'], function () {
        Route::get('/', [Jadwal::class, 'index'])->name('jadwal');
        Route::get('/data', [Jadwal::class, 'show'])->name('jadwal.data');
        Route::post('/store', [Jadwal::class, 'store'])->name('jadwal.store');
        Route::get('/edit/{id}', [Jadwal::class, 'edit'])->name('jadwal.edit');
        Route::post('/update', [Jadwal::class, 'update'])->name('jadwal.update');
        Route::get('/delete/{id}', [Jadwal::class, 'destroy'])->name('jadwal.delete');
    });

    Route::group(['prefix' => '/reservasi'], function () {
        Route::get('/', [Reservasi::class, 'index'])->name('reservasi');
        Route::get('/data', [Reservasi::class, 'show'])->name('reservasi.data');
        Route::post('/store', [Reservasi::class, 'store'])->name('reservasi.store');
        Route::get('/edit/{id}', [Reservasi::class, 'edit'])->name('reservasi.edit');
        Route::post('/update', [Reservasi::class, 'update'])->name('reservasi.update');
        Route::get('/delete/{id}', [Reservasi::class, 'destroy'])->name('reservasi.delete');
        Route::get('/dokter/{id}', [Reservasi::class, 'dokter'])->name('reservasi.dokter');
        Route::get('/jadwal/{id}', [Reservasi::class, 'jadwal'])->name('reservasi.jadwal');
    });

    Route::group(['prefix' => '/pemeriksaan'], function () {
        Route::get('/riwayat', [Pemeriksaan::class, 'riwayat'])->name('pemeriksaan.riwayat');
        Route::get('/data', [Pemeriksaan::class, 'show'])->name('pemeriksaan.data');
        Route::post('/store', [Pemeriksaan::class, 'store'])->name('pemeriksaan.store');
        Route::get('/edit/{id}', [Pemeriksaan::class, 'edit'])->name('pemeriksaan.edit');
        Route::post('/update', [Pemeriksaan::class, 'update'])->name('pemeriksaan.update');
        Route::get('/delete/{id}', [Pemeriksaan::class, 'destroy'])->name('pemeriksaan.delete');
        Route::get('/export/{id}', [Pemeriksaan::class, 'export'])->name('pemeriksaan.export');
        Route::get('/{id}', [Pemeriksaan::class, 'index'])->name('pemeriksaan');
    });

    Route::group(['prefix' => '/informasi'], function () {
        Route::get('/', [Informasi::class, 'index'])->name('informasi.riwayat');
        Route::get('/data', [Informasi::class, 'show'])->name('informasi.data');
        Route::post('/store', [Informasi::class, 'store'])->name('informasi.store');
        Route::get('/edit/{id}', [Informasi::class, 'edit'])->name('informasi.edit');
        Route::post('/update', [Informasi::class, 'update'])->name('informasi.update');
        Route::get('/delete/{id}', [Informasi::class, 'destroy'])->name('informasi.delete');
    });

    Route::get('/pengaturanjadwal', [Pengaturan::class, 'index']);
    Route::get('/noselanjutnya/{id}', [Pengaturan::class, 'skip']);

    Route::post('/gantipass', [Password::class, 'ganti'])->name('password.ganti');

    Route::get('/firebase', [FirebaseController::class, 'index']);
    Route::get('/cek', [FirebaseController::class, 'cek']);
});
