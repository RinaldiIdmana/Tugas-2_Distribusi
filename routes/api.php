<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\StudentController; // Perbaikan 2: Tambahkan baris ini
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
// Route::get('student', [StudentController::class, 'index']);
// Route::get('student/{id}', [StudentController::class, 'show']);
// Route::post('student', [StudentController::class, 'store']);
// Route::delete('student/{id}', [StudentController::class, 'destroy']);

Route::apiResource('student', StudentController::class);