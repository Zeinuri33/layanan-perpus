<?php

namespace App\Http\Controllers\Layanan;

use App\Http\Controllers\Controller;
use App\Models\Layanan\Layanan_plagiasi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DokumenController extends Controller
{
    public function store(Request $request)
    {
         // Simpan data ke database
         Layanan_plagiasi::create([
             'mahasiswa' => $request->mahasiswa,
             'pembimbing' => $request->pembimbing,
         ]);


        return redirect('/admin/layanan-plagiasi')->with('success', 'Data berhasil disimpan.');
    }
}
