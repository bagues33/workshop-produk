<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;

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
    return view('welcome');
});

Route::get('/home', function() {
    return view('home');
});

Route::group(['prefix' => 'kategori-produk', "as" => 'kategori-produk.'], function () {
    Route::get('/', [App\Http\Controllers\KategoriController::class, 'index'])->name('index');
    Route::get('/create', [App\Http\Controllers\KategoriController::class, 'create'])->name('create');
    Route::post('/store', [App\Http\Controllers\KategoriController::class, 'store'])->name('store');
    Route::get('/edit/{kategori_produk}', [App\Http\Controllers\KategoriController::class, 'edit'])->name('edit');
    Route::post('/update/{kategori_produk}', [App\Http\Controllers\KategoriController::class, 'update'])->name('update');
    Route::get('/delete/{kategori_produk}', [App\Http\Controllers\KategoriController::class, 'delete'])->name('delete');
});

Route::group(['prefix' => 'produk', "as" => 'produk.'], function() {
    Route::get('/', [App\Http\Controllers\ProdukController::class, 'index'])->name('index');
    Route::get('/create', [App\Http\Controllers\ProdukController::class, 'create'])->name('create');
    Route::post('/store', [App\Http\Controllers\ProdukController::class, 'store'])->name('store');
    Route::get('/edit/{produk}', [App\Http\Controllers\ProdukController::class, 'edit'])->name('edit');
    Route::post('/update/{produk}', [App\Http\Controllers\ProdukController::class, 'update'])->name('update');
    Route::get('/delete/{produk}', [App\Http\Controllers\ProdukController::class, 'delete'])->name('delete');
});