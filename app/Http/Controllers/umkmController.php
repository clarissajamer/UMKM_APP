<?php

namespace App\Http\Controllers;

use App\Models\umkm;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class umkmController extends Controller
{

    public function index(Request $request)
    {
        $data['result'] = \App\Models\umkm::all();

        if ($request->expectsJson()) {
            return response()->json($data);
        }

        return view('umkm/index')->with($data);
    }

    public function show($id)
    {
        $umkm = umkm::find($id);
        return view('umkm.detail', compact('umkm'));
    }
    
    public function create() {
        return view('umkm/form');  
    }   

    public function store(Request $request) {
        $validated = $request->validate([
            'umkm_name' => ['required', 'max:100', 'regex:/^[a-zA-Z0-9\s\-]+$/'],
            'owner_name' => ['required', 'max:100', 'regex:/^[a-zA-Z\s]+$/'],
            'umkm_desc' => ['required', 'regex:/^[a-zA-Z0-9\s.,\-]+$/'],
            'phone' => ['required', 'digits_between:10,15', 'regex:/^[0-9]+$/'],
            'email' => 'required|email|max:50|unique:umkm,email',
            'address' => ['required', 'regex:/^[a-zA-Z0-9\s.,\-]+$/'],
            'images' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $validated['images'] = $filename;
        }

        $status = \App\Models\umkm::create($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'status' => $status,
                'message' => $status ? 'Berhasil ditambah' : 'Gagal ditambah'
            ]);
        }

        if($status) return redirect('umkm')->with('success', 'Data berhasil ditambahkan');
        else return redirect('umkm')->with('error', 'Data gagal ditambahkan');
    }

    public function edit($id) {
        $data['result'] = \App\Models\umkm::where('id', $id)->first();
        return view('umkm.form')->with($data);
    }
    
    public function update(Request $request, $id) {
        $validated = $request->validate([
            'umkm_name' => ['required', 'max:100', 'regex:/^[a-zA-Z0-9\s\-]+$/'],
            'owner_name' => ['required', 'max:100', 'regex:/^[a-zA-Z\s]+$/'],
            'umkm_desc' => ['required', 'regex:/^[a-zA-Z0-9\s.,\-]+$/'],
            'phone' => ['required', 'digits_between:10,15', 'regex:/^[0-9]+$/'],
            'email' => [
                'required',
                'email',
                'max:50',
                Rule::unique('umkm', 'email')->ignore($id),
            ],
            'address' => ['required', 'regex:/^[a-zA-Z0-9\s.,\-]+$/'],
            'images' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $umkm = \App\Models\umkm::where('id', $id)->first();

        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $validated['images'] = $filename;
        }

        $status = $umkm->update($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'status' => $status ? true : false,
                'message' => $status ? 'Update berhasil' : 'Update gagal',
            ], $status ? 200 : 500);
        }

        if($umkm) return redirect('umkm')->with('success', 'Data berhasil diubah');
        else return redirect('umkm')->with('error', 'Data gagal diubah');
    }

    public function destroy(Request $request,$id) {
        $result = \App\Models\umkm::Where('id', $id)->first();
        $status = $result->delete();

        if ($request->expectsJson()) {
            return response()->json([
                'status' => $status ? true : false,
                'message' => $status ? 'Update berhasil' : 'Update gagal',
            ], $status ? 200 : 500);
        }

        if($status) return redirect('umkm')->with('success', 'Data Berhasil dihapus');
        else return redirect('umkm')->with('error', 'Data Gagal dihapus');
    }
}
