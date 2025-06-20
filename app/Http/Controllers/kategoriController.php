<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class KategoriController extends Controller
{

    public function index(Request $request)
    {
        $data['result'] = \App\Models\kategori::all();

        if ($request->expectsJson()) {
            return response()->json($data);
        }

        return view('kategori/index')->with($data);
    }
    
    public function create() {
        return view('kategori/form');
    }   

    public function store(Request $request) {
        $validated = $request->validate([
            'category' => [
                'required',
                'max:100',
                'regex:/^[a-zA-Z0-9\s\-]+$/'
            ],
        ]);

        $status = \App\Models\kategori::create($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'status' => $status ? true : false,
                'message' => $status ? 'Update berhasil' : 'Update gagal',
            ], $status ? 200 : 500);
        }

        if($status) return redirect('kategori')->with('success', 'Data berhasil ditambahkan');
        else return redirect('kategori')->with('error', 'Data gagal ditambahkan');
    }

    public function edit($id) {
        $data['result'] = \App\Models\kategori::where('id', $id)->first();
        return view('kategori.form')->with($data);
    }
    
    public function update(Request $request, $id) {
        $validated = $request->validate([
            'category' => [
                'required',
                'max:100',
                'regex:/^[a-zA-Z0-9\s\-]+$/'
            ],
        ]);

        $kategori = \App\Models\kategori::where('id', $id)->first();

        $status = $kategori->update($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'status' => $status ? true : false,
                'message' => $status ? 'Update berhasil' : 'Update gagal',
            ], $status ? 200 : 500);
        }

        if($kategori) return redirect('kategori')->with('success', 'Data berhasil diubah');
        else return redirect('kategori')->with('error', 'Data gagal diubah');
    }

    public function destroy(Request $request, $id) {
        $result = \App\Models\kategori::Where('id', $id)->first();
        $status = $result->delete();

        if ($request->expectsJson()) {
            return response()->json([
                'status' => $status ? true : false,
                'message' => $status ? 'Update berhasil' : 'Update gagal',
            ], $status ? 200 : 500);
        }

        if($status) return redirect('kategori')->with('success', 'Data Berhasil dihapus');
        else return redirect('kategori')->with('error', 'Data Gagal dihapus');
    }
}