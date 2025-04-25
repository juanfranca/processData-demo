<?php

use App\Http\Controllers\AuditFileController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FileRegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('file')->group(function () {
    Route::get('/', [FileController::class, 'index']);
    Route::get('/{id}', [FileController::class, 'show']);
    Route::post('create', [FileController::class, 'create']);
    Route::delete('delete/{id}', [FileController::class, 'delete']);
    Route::post('process-file/{id}', [FileController::class, 'processFile']);
});

Route::prefix('audit')->group(function(){
    Route::get('/', [AuditFileController::class, 'index']);
    Route::get('/{id}', [AuditFileController::class, 'show']);
});

Route::prefix('register')->group(function(){
    Route::get('/', [FileRegisterController::class, 'index']);
    Route::get('/{id}', [FileRegisterController::class, 'show']);
});
