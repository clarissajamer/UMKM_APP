<?php

use App\Http\Controllers\imageController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\umkmController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

Route::get('/', function () {
    return redirect('/produk');
});

Route::get('/api/list-uploads', function () {
    $uploadPath = public_path('uploads');

    if (!File::exists($uploadPath)) {
        return response()->json(['error' => 'Folder uploads tidak ditemukan'], 404);
    }

    $files = File::files($uploadPath);
    $data = [];

    foreach ($files as $file) {
        $data[] = [
            'filename' => $file->getFilename(),
            'url' => url('uploads/' . $file->getFilename())
        ];
    }

    return response()->json($data);
});

// route produk

Route::get('/produk', [ProdukController::class, 'index']);
Route::get('produk/{id}/detail', [ProdukController::class, 'show']);

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
Route::get('umkm/{id}/detail', [umkmController::class, 'show']);

Route::get('umkm/add', [umkmController::class, 'create']);
Route::post('umkm', [umkmController::class, 'store']);

Route::get('umkm/{id}/edit', [umkmController::class, 'edit']);
Route::patch('umkm/{id}/edit', [umkmController::class, 'update']);

Route::delete('umkm/{id}/delete', [umkmController::class, 'destroy']);

// route image

Route::get('/image', [imageController::class, 'index']);
Route::get('image/{id}/detail', [imageController::class, 'show']);

Route::get('image/add', [imageController::class, 'create']);
Route::post('image', [imageController::class, 'store']);

Route::get('image/{id}/edit', [imageController::class, 'edit']);
Route::patch('image/{id}/edit', [imageController::class, 'update']);

Route::delete('image/{id}/delete', [imageController::class, 'destroy']);

// Route::get('/api/test', function () {
//     return response()->json(['status' => 'API OK']);
// });
