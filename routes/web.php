<?php

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\umkmController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/produk');
});

// route produk

Route::get('/produk', [ProdukController::class, 'index']);

Route::get('produk/add', [ProdukController::class, 'create']);
Route::post('produk', [ProdukController::class, 'store']);

Route::get('produk/{id}/edit', [ProdukController::class, 'edit']);
Route::patch('produk/{id}/edit', [ProdukController::class, 'update']);

Route::delete('produk/{id}/delete', [ProdukController::class, 'destroy']);

// route kategori

Route::get('/kategori', [KategoriController::class, 'index']);

Route::get('kategori/add', [KategoriController::class, 'create']);
Route::post('kategori', [KategoriController::class, 'store']);

Route::get('kategori/{id}/edit', [KategoriController::class, 'edit']);
Route::patch('kategori/{id}/edit', [KategoriController::class, 'update']);

Route::delete('kategori/{id}/delete', [KategoriController::class, 'destroy']);

// route umkm

Route::get('/umkm', [umkmController::class, 'index']);

Route::get('umkm/add', [umkmController::class, 'create']);
Route::post('umkm', [umkmController::class, 'store']);

Route::get('umkm/{id}/edit', [umkmController::class, 'edit']);
Route::patch('umkm/{id}/edit', [umkmController::class, 'update']);

Route::delete('umkm/{id}/delete', [umkmController::class, 'destroy']);

// Route::get('/api/test', function () {
//     return response()->json(['status' => 'API OK']);
// });
