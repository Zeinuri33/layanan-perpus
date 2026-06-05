<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class KegiatanController extends Controller
{
    //
    public function index()
    {
        $kegiatan = Kegiatan::latest()->get();
        $user = User::latest()->get();

        return view('admin.kegiatan.index', compact('kegiatan', 'user'));
    }

    public function store(Request $request)
    {
        Kegiatan::create([
            'kegiatan' => $request->kegiatan,
            'kategori' => $request->kategori,
            'tanggal' => $request->tanggal,
            'pj' => $request->pj,
            'slug' => Carbon::parse($request->tanggal)->isoFormat('MMMM-Y'),
            'ket' => 'Belum',
        ]);

        return redirect('/admin/kegiatan')->with('success', 'Alhamdulillah, kegiatan berhasil tersimpan');
    }

    public function update(Request $request, $id)  : RedirectResponse
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $kegiatan->update([
            'kegiatan' => $request->kegiatan,
            'kategori' => $request->kategori,
            'tanggal' => $request->tanggal,
            'pj' => $request->pj,
            'slug' => Carbon::parse($request->tanggal)->isoFormat('MMMM-Y'),
        ]);

        return redirect('/admin/kegiatan')->with('success', 'Alhamdulillah, kegiatan berhasil diperbarui');
    }

    public function ubah(Request $request, $id) : RedirectResponse
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $kegiatan->update([
            'ket' => $request->ket
        ]);

        return redirect('/admin/kegiatan')->with('success', 'Alhamdulillah, kegiatan berhasil terlaksana');
    }

    public function hapus($id): RedirectResponse
    {
        //get post by ID
        $kegiatan = Kegiatan::findOrFail($id);

        $kegiatan->delete();

        $title = 'Hapus Data!';
        $text = "Apakah anda yakin menghapus data terpilih?";
        confirmDelete($title, $text);

        //redirect to index
        return redirect(route('kegiatan.index'))->with('success', 'Alhamdulillah, kegiatan berhasil dihapus!');
    }

    public function kegiatan_list(Request $request, $slug)
    {
        $kegiatan = Kegiatan::all();

        return view('kegiatan.kegiatan', compact('kegiatan'));
    }


    public function list_kegiatan(Request $request, $slug)
    {
        $events = Kegiatan::all();

        return view('keg', compact('events'));
    }

    public function absen_kegiatan($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        return view('admin.kegiatan.absen');
    }

    public function absen(Request $request, $kegiatan_id)
    {
        $request->validate([
            'nim' => 'required'
        ]);

        $nim = $request->nim;

        // Panggil API OPAC
        $url = "https://opac.lib.ibrahimy.ac.id/api/MahasiswaApiController.php";
        $response = Http::get($url, [
            'nim' => $nim,
            'token' => 'lib180597'
        ]);

        if (!$response->ok()) {
            return back()->with('error', 'Gagal terhubung server OPAC.');
        }

        $data = $response->json();

        // Cek apakah data valid
        if (!$data || !isset($data['nama'])) {
            return back()->with('error', 'NIM tidak ditemukan di OPAC.');
        }

        // Simpan ke tabel absen
        AbsenKegiatan::create([
            'nim' => $nim,
            'nama' => $data['nama'],
            'kegiatan_id' => $kegiatan_id,
        ]);

        return back()->with('success', "Absensi berhasil untuk {$data['nama']}");
    }
}














































