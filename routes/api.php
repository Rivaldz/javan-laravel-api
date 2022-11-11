<?php

use App\Http\Controllers\ContactApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/contact/anak-budi', [ContactApiController::class, 'getAnakBudi']);
Route::get('/contact/cucu-budi', [ContactApiController::class, 'getCucuBudi']);
Route::get('/contact/cucu-perempuan-budi', [ContactApiController::class, 'getCucuPerempuanBudi']);
Route::get('/contact/bibi-farah', [ContactApiController::class, 'getBibi']);
Route::get('/contact/sepupu-laki', [ContactApiController::class, 'getSepupuLaki']);
Route::apiResource('/contact', ContactApiController::class);
