<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokumenSiswaController;
use App\Http\Controllers\GURU\MataPelajaranController;
use App\Http\Controllers\GURU\SiswaController as GURUSiswaController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('auth.login');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {

    Route::name('dashboard.')->prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');

        Route::middleware(['guru'])->group(function () {
            Route::resource('siswas', GURUSiswaController::class);
            Route::resource('siswas.nilai', MataPelajaranController::class);
        });
    });
});
