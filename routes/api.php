<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\ProdukController;

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

Route::group(['prefix' => 'kategori-produk', "as" => 'kategori-produk.'], function () {
    Route::get('/', [KategoriController::class, 'list'])->name('list');
    Route::post('/create', [KategoriController::class, 'create'])->name('create');
    Route::get('/view/{id}', [KategoriController::class, 'view'])->name('view');
    Route::put('/update/{id}', [KategoriController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [KategoriController::class, 'delete'])->name('delete');
});

Route::group(['prefix' => 'produk', "as" => 'produk.'], function () {
    Route::get('/', [ProdukController::class, 'list'])->name('list');
    Route::post('/create', [ProdukController::class, 'create'])->name('create');
    Route::get('/view/{id}', [ProdukController::class, 'view'])->name('view');
    Route::put('/update/{id}', [ProdukController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [ProdukController::class, 'delete'])->name('delete');
});

