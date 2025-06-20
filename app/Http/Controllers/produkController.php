<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use App\Models\produk;
use App\Models\umkm;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use PhpParser\Builder\Function_;

class ProdukController extends Controller
{

    public function index(Request $request)
    {
        $data = produk::with('kategori', 'umkm')->get();

        if ($request->expectsJson()) {
            return response()->json($data);
        }

        return view('produk.index', ['produk' => $data]);
    }

    public function show($id)
    {
        $produk = produk::with(['kategori', 'umkm'])->findOrFail($id);
        return view('produk.detail', compact('produk'));
    }
    
    public function create() {
        $kategori = kategori::all();
        $umkm = umkm::all();
        return view('produk.form', compact('kategori', 'umkm'));  
    }   

    public function store(Request $request) {
        $validated = $request->validate([
            'id_kategori' => 'required|exists:kategori,id',
            'id_umkm' => 'required|exists:umkm,id',
            'title' => [
                'required',
                'max:100',
                'regex:/^[a-zA-Z0-9\s\-]+$/'
            ],
            'rating' => 'required|numeric|between:0,5',
            'price' => [
                'required',
                'regex:/^\d+$/'
            ],
            'description' => [
                'required',
                'regex:/^[a-zA-Z0-9\s.,\-]+$/'
            ],
            'images' => 'required|mimes:jpeg,png,webp ,svg,jpg|max:2048',
        ]);

        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $validated['images'] = $filename;
        }

        $status = \App\Models\produk::create($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'status' => $status ? true : false,
                'message' => $status ? 'Berhasil ditambah' : 'Gagal ditambah',
            ], $status ? 200 : 500);
        }

        if($status) return redirect('produk')->with('success', 'Data berhasil ditambahkan');
        else return redirect('produk')->with('error', 'Data gagal ditambahkan');
    }

    public function edit($id) {
        $data['result'] = \App\Models\produk::where('id', $id)->first();
        return view('produk.form')->with($data);
    }
    
    public function update(Request $request, $id) {
        $validated = $request->validate([
            'id_kategori' => 'required|exists:kategori,id',
            'id_umkm' => 'required|exists:umkm,id',
            'title' => [
                'required',
                'max:100',
                'regex:/^[a-zA-Z0-9\s\-]+$/'
            ],
            'rating' => 'required|numeric|between:0,5',
            'price' => [
                'required',
                'regex:/^\d+$/'
            ],
            'description' => [
                'required',
                'regex:/^[a-zA-Z0-9\s.,\-]+$/'
            ],
            'images' => 'required|mimes:jpeg,png,webp ,svg,jpg|max:2048',
        ]);  

        $produk = \App\Models\produk::where('id', $id)->first();

        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $validated['images'] = $filename;
        }

        $status = $produk->update($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'status' => $status ? true : false,
                'message' => $status ? 'Update berhasil' : 'Update gagal',
            ], $status ? 200 : 500);
        }

        if($produk) return redirect('produk')->with('success', 'Data berhasil diubah');
        else return redirect('produk')->with('error', 'Data gagal diubah');
    }

    public function destroy(Request $request, $id) {
        $result = \App\Models\produk::Where('id', $id)->first();
        $status = $result->delete();

        if ($request->expectsJson()) {
            return response()->json([
                'status' => $status ? true : false,
                'message' => $status ? 'Update berhasil' : 'Update gagal',
            ], $status ? 200 : 500);
        }

        if($status) return redirect('produk')->with('success', 'Data Berhasil dihapus');
        else return redirect('produk')->with('error', 'Data Gagal dihapus');
    }

}