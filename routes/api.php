<?php

use App\Http\Controllers\API\JurusanController;
use App\Http\Controllers\API\RequestController;
use App\Http\Controllers\API\SemesterController;
use App\Http\Controllers\API\SiswaController;
use App\Http\Controllers\API\UserController;
use App\Models\RequestSiswa;
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

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('user', [UserController::class, 'fetch']);
    Route::post('user', [UserController::class, 'updateProfile']);
    Route::post('logout', [UserController::class, 'logout']);

    Route::get('requested', [RequestController::class, 'all']);
    Route::post('request', [RequestController::class, 'requestDetail']);
});

Route::get('siswa', [SiswaController::class, 'all']);
Route::get('jurusan', [JurusanController::class, 'all']);
Route::get('semester', [SemesterController::class, 'all']);

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);

// Route::get('requested', [RequestController::class, 'all']);
// Route::post('request', [RequestController::class, 'requestDetail']);
