<?php

namespace App\Http\Controllers\Universitas;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    //
    public function index()
    {
        $dosen = Dosen::latest()->get();

        return view('admin.universitas.dosen.index', compact('dosen'));
    }

    public function store(Request $request)
    {
        Dosen::create([
            'nidn' => $request->nidn,
            'nama' => $request->nama,
            'prodi' => $request->prodi,
            'nomor' => $request->nomor,
        ]);

        return back()->with('success', 'data berhasil ditambahkan');

    }

    public function edit($id)
    {
        $dosen = Dosen::findOrFail($id);

        return view('admin.universitas.dosen.edit', compact('dosen'));
    }

    public function update(Request $request, $id)
    {
        $dosen = Dosen::findOrFail($id);

        $dosen->update([
            'nidn' => $request->nidn,
            'nama' => $request->nama,
            'prodi' => $request->prodi,
            'nomor' => $request->nomor,
        ]);

        return redirect('/admin/dosen')->with('success', 'data berhasil diperbarui');
    }


    public function destroy($id)
    {
        $dosen = Dosen::findOrFail($id);
        $dosen->delete();

        return back()->with('success', 'data berhasil dihapus');
    }

}
