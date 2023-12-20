<?php

use App\Http\Controllers\MenuController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UploadController;
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
Route::post("/login", [AuthController::class, 'login']);
Route::get("/logout", [AuthController::class, 'logout']);

Route::group([
    'middleware' => ['auth.rest'],
    'prefix' => 'transaksi'
], function () {
    Route::get('list', [TransaksiController::class, 'list']);
    Route::get('history', [TransaksiController::class, 'history']);
    Route::get('detail/{id}', [TransaksiController::class, 'detail']);
    Route::get('update-status-transaksi/{id}', [TransaksiController::class, 'updateStatusTransaksi']);
    Route::post('create', [TransaksiController::class, 'create']);
    Route::get('rekap-shift', [TransaksiController::class, 'rekapShift']);
});

Route::group([
    'middleware' => ['auth.rest'],
    'prefix' => 'menu'
], function () {
    Route::get('list', [MenuController::class, 'list']);
});

// crud routes
Route::group([
    'middleware' => ['auth.rest']
], function () {
    Route::get('/', function () {
        return response()->json(['message' => 'Hello World!'], 200);
    });
    Route::get('/me', [AuthController::class, 'me']);
    // crud routes
    Route::post('upload', [UploadController::class, 'upload'])->name("upload")->middleware('auth.rest');

});



