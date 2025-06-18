<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class imageController extends Controller
{
    public function index(Request $request)
    {
        $data['result'] = \App\Models\image::all();

        if ($request->expectsJson()) {
            return response()->json($data);
        }

        return view('image.index')->with($data);
    }
    
    public function create() {
        return view('image.form');
    }   

    public function store(Request $request) {
        $validated = $request->validate([
            'images' => 'required|url',
        ]);

        $status = \App\Models\image::create($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'status' => $status ? true : false,
                'message' => $status ? 'Update berhasil' : 'Update gagal',
            ], $status ? 200 : 500);
        }

        if($status) return redirect('image')->with('success', 'Data berhasil ditambahkan');
        else return redirect('image')->with('error', 'Data gagal ditambahkan');
    }

    public function edit($id) {
        $data['result'] = \App\Models\image::where('id', $id)->first();
        return view('image.form')->with($data);
    }
    
    public function update(Request $request, $id) {
        $validated = $request->validate([
            'images' => 'required|url',
        ]);

        $image = \App\Models\image::where('id', $id)->first();

        $status = $image->update($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'status' => $status ? true : false,
                'message' => $status ? 'Update berhasil' : 'Update gagal',
            ], $status ? 200 : 500);
        }

        if($image) return redirect('image')->with('success', 'Data berhasil diubah');
        else return redirect('image')->with('error', 'Data gagal diubah');
    }

    public function destroy(Request $request, $id) {
        $result = \App\Models\image::Where('id', $id)->first();
        $status = $result->delete();

        if ($request->expectsJson()) {
            return response()->json([
                'status' => $status ? true : false,
                'message' => $status ? 'Update berhasil' : 'Update gagal',
            ], $status ? 200 : 500);
        }

        if($status) return redirect('image')->with('success', 'Data Berhasil dihapus');
        else return redirect('image')->with('error', 'Data Gagal dihapus');
    }
}
