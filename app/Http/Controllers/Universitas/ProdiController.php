<?php

namespace App\Http\Controllers\Universitas;

use App\Models\Prodi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProdiController extends Controller
{
    //
    public function index()
    {
        $prodi = Prodi::latest()->get();

        return view('admin.universitas.prodi.index', compact('prodi'));
    }

    public function store(Request $request)
    {
        Prodi::create([
            'prodi' => $request->prodi,
            'kode' => $request->kode,
            'fakultas' => $request->fakultas,
            'kontak' => $request->kontak
        ]);

        return back()->with('success', 'data berhasil ditambahkan');

    }

    public function update(Request $request, $id)
    {
        $prodi = Prodi::findOrFail($id);

        $prodi->update([
            'prodi' => $request->prodi,
            'kode' => $request->kode,
            'fakultas' => $request->fakultas,
            'kontak' => $request->kontak
        ]);

        return back()->with('success', 'data berhasil diperbarui');

    }

    public function destroy($id)
    {
        $prodi = Prodi::findOrFail($id);

        $prodi->delete();

        return back()->with('success', 'data berhasil dihapus');
    }
}
