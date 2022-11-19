<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PasienCovid;
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

# Membuat route register dan login
# Method post
Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);

# Melakukan protect routes
Route::middleware(['auth:sanctum'])->group(function() {

# Mendapatkan semua resource
# method get
Route::get('/pasiens', [PasienCovid::class, 'index']);

});

# Menambahkan Resource
# method post
Route::post('/pasiens', [PasienCovid::class, 'store']);

# mendapatkan detail resource pasien
# method get
Route::get('/pasiens/{id}', [PasienCovid::class, 'show']);

# Memperbarui single resource
# Method put
Route::put('/pasiens/{id}', [PasienCovid::class, 'update']);

# Menghapus single resource
# Method delete
Route::delete('/pasiens/{id}', [PasienCovid::class, 'destroy']);

# Mencari resource by name
# Method get
Route::get('/pasiens/search/{name}', [PasienCovid::class, 'search']);

# Menampilkan resource pasien positif
# Method get
Route::get('/pasiens/status/positive', [PasienCovid::class, 'positive']);

# Menampilkan resource pasien sembuh
# Method get
Route::get('/pasiens/status/recovered', [PasienCovid::class, 'recovered']);

# Menampilkan resource pasien meninggal
# Method get
Route::get('/pasiens/status/dead', [PasienCovid::class, 'dead']);