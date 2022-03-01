<?php

use App\Http\Controllers\API\UserController as APIUserController;
use App\Http\Controllers\COMPANY\RequestSiswaController;
use App\Http\Controllers\COMPANY\RequestSiswaDetailController as COMPANYRequestSiswaDetailController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokumenSiswaController;
use App\Http\Controllers\GURU\MataPelajaranController;
use App\Http\Controllers\GURU\SiswaController as GURUSiswaController;
use App\Http\Controllers\RequestSiswaController as ControllersRequestSiswaController;
use App\Http\Controllers\RequestSiswaDetailController;
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

        Route::middleware(['admin'])->group(function () {
            Route::resource('siswa', SiswaController::class);
            Route::resource('siswa.dokumen', DokumenSiswaController::class)->shallow()->only([
                'index', 'create', 'store', 'destroy'
            ]);
            Route::resource('user', UserController::class)->only([
                'index', 'edit', 'update', 'destroy'
            ]);
            Route::resource('requesting', ControllersRequestSiswaController::class);
            Route::resource('requesting.detail', RequestSiswaDetailController::class)->shallow()->only([
                'index', 'create', 'store', 'destroy'
            ]);
            // Route::resource('category', ProductCategoryController::class);
            // Route::resource('product.gallery', ProductGalleryController::class)->shallow()->only([
            //     'index', 'create', 'store', 'destroy'
            // ]);
            // Route::resource('transaction', TransactionController::class)->only([
            //     'index', 'show', 'edit', 'update'
            // ]);
        });

        Route::middleware(['guru'])->group(function () {
            Route::resource('siswas', GURUSiswaController::class);
            Route::resource('siswas.nilai', MataPelajaranController::class)->shallow()->only([
                'index', 'create', 'store', 'destroy', 'edit', 'update'
            ]);
        });

        Route::middleware(['company'])->group(function () {
            Route::resource('requested', RequestSiswaController::class);
            Route::resource('requested.details', COMPANYRequestSiswaDetailController::class)->shallow()->only([
                'index', 'destroy'
            ]);
        });
    });
});
