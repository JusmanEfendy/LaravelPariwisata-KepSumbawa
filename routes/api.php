<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WisataApiController;
use App\Models\Kelurahan;

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

Route::get('/wisata', [WisataApiController::class, 'index']);
Route::get('/kelurahan/{id_kecamatan}', function ($kecamatan_id) {
    return Kelurahan::where('id_kecamatan', $kecamatan_id)->get();
});
