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
            'umkm_name' => 'required|max:100',
            'owner_name' => 'required|max:100',
            'umkm_desc' => 'required',
            'phone' => 'required|digits_between:10,15',
            'email' => 'required|email|max:50|unique:umkm,email',
            'address' => 'required',
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
            'umkm_name' => 'required|max:100',
            'owner_name' => 'required|max:100',
            'umkm_desc' => 'required',
            'phone' => 'required|digits_between:10,15',
            'email' => [
                'required',
                'email',
                'max:50',
                Rule::unique('umkm', 'email')->ignore($id),
            ],
            'address' => 'required',
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

    // alur online first

    // public function index()
    // {
    //     $data = umkm::get();
    //     return response()->json($data);
    // }

    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'umkm_name' => 'required|max:100',
    //         'owner_name' => 'required|max:100',
    //         'umkm_desc' => 'required|max:255',
    //         'phone' => 'required|digits_between:10,15',
    //         'email' => 'required|email|max:50|unique:umkm,email',
    //         'address' => 'required|max:255',
    //         'images' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    //     ]);

    //     if ($request->hasFile('images')) {
    //         $file = $request->file('images');
    //         $filename = time() . '_' . $file->getClientOriginalName();
    //         $file->move(public_path('uploads'), $filename); // simpan di public/uploads
    //         $validated['images'] = 'uploads/' . $filename;  // simpan path relatif
    //     }

    //     $data = umkm::create($validated);

    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Data Berhasil Ditambahkan',
    //         'data' => $data
    //     ]);
    // }

    // public function show(string $id)
    // {
    //     $data = umkm::find($id);
    //     if (!$data) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'umkm tidak ditemukan',
    //         ], 404);
    //     }
    //     return response()->json([
    //         'status' => true,
    //         'data' => $data
    //     ], 200);
    // }
    
    // public function update(Request $request, string $id)
    // {
    //     $data = umkm::findOrFail($id);

    //     $validated = $request->validate([
    //         'umkm_name' => 'required|max:100',
    //         'owner_name' => 'required|max:100',
    //         'umkm_desc' => 'required|max:255',
    //         'phone' => 'required|digits_between:10,15',
    //         'email' => [
    //             'required',
    //             'email',
    //             'max:50',
    //             Rule::unique('umkm', 'email')->ignore($id),
    //         ],
    //         'address' => 'required|max:255',
    //         'images' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    //     ]);

    //     if ($request->hasFile('images')) {
    //         // Hapus images lama jika ada
    //         if ($data->images && file_exists(public_path($data->images))) {
    //             unlink(public_path($data->images));
    //         }

    //         $file = $request->file('images');
    //         $filename = time() . '_' . $file->getClientOriginalName();
    //         $file->move(public_path('uploads'), $filename);
    //         $validated['images'] = 'uploads/' . $filename;
    //     }

    //     $data->update($validated);

    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Update berhasil',
    //         'data' => $data
    //     ], 200);
    // }

    // public function destroy(string $id)
    // {
    //     $data = umkm::find($id);
    //     if (!$data) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'umkm tidak ditemukan',
    //         ], 404);
    //     }

    //     // Hapus file gambar
    //     if ($data->images && file_exists(public_path($data->images))) {
    //         unlink(public_path($data->images));
    //     }

    //     $data->delete();

    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Update berhasil',
    //     ], 200);
    // }
}
