<?php

namespace App\Http\Controllers;

use App\Models\image;
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
            'nama' => [
                'required',
                'max:100',
                'regex:/^[a-zA-Z0-9\s\-]+$/'
            ],
            'images' => 'required|mimes:jpeg,png,webp,svg,jpg|max:2048',
        ]);

        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $validated['images'] = $filename;
        }

        $status = \App\Models\image::create($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'status' => $status ? true : false,
                'message' => $status ? 'Berhasil ditambah' : 'Gagal ditambah',
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
            'nama' => [
                'required',
                'max:100',
                'regex:/^[a-zA-Z0-9\s\-]+$/'
            ],
            'images' => 'required|mimes:jpeg,png,webp,svg,jpg|max:2048',
        ]);  

        $image = \App\Models\image::where('id', $id)->first();

        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $validated['images'] = $filename;
        }

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
