<?php

use App\Http\Controllers\Api\DokterController;
use App\Http\Controllers\Api\PasienController;
use App\Http\Controllers\Api\PoliController;
use App\Http\Controllers\Api\ReservasiController;
use App\Http\Controllers\Api\InformasiController;
use App\Models\Informasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/poli', [PoliController::class, 'index']);
Route::get('/dokter/{id}', [DokterController::class, 'index']);
Route::get('/user/{id}', [PasienController::class, 'user']);
Route::post('/cekregis', [PasienController::class, 'regis']);
Route::post('/regis', [PasienController::class, 'store']);
Route::post('/reservasi', [ReservasiController::class, 'store']);
Route::post('/cekreservasi', [ReservasiController::class, 'cek']);

Route::get('/jadwal', [PoliController::class, 'jadwal']);
Route::get('/reservasi/{id}', [ReservasiController::class, 'reservasi']);
Route::get('/status', [ReservasiController::class, 'status']);
Route::get('/riwayat/{id}', [ReservasiController::class, 'riwayat']);

Route::get('/batal/{id}', [ReservasiController::class, 'batal']);

Route::get('/informasi', [InformasiController::class, 'index']);
Route::get('/informasi/{id}', [InformasiController::class, 'view']);
