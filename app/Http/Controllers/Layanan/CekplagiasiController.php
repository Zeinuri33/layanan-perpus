<?php

namespace App\Http\Controllers\Layanan;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Layanan\Layanan_plagiasi;
use App\Models\Layanan\Riwayat_plagiasi;
use App\Models\Layanan\Skripsi;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CekplagiasiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        // ================= DEFAULT ANGKATAN =================
        $defaultAngkatan = now()->year - 4;
        $angkatan = $request->filled('angkatan')
            ? $request->angkatan
            : $defaultAngkatan;

        // ================= RATA-RATA PLAGIASI =================
        $rataPlagiasi = DB::table('prodis as p')
            ->leftJoin('mahasiswas as m', function ($join) use ($angkatan) {
                $join->on('p.id', '=', 'm.prodi_id')
                    ->where('m.angkatan', $angkatan);
            })
            ->leftJoin('layanan_plagiasis as lp', 'm.id', '=', 'lp.mahasiswa_id')
            ->leftJoin('riwayat_plagiasis as rp', function ($join) {
                $join->on('lp.id', '=', 'rp.layanan_plagiasi_id')
                    ->whereRaw('rp.created_at = (
                        SELECT MAX(created_at)
                        FROM riwayat_plagiasis
                        WHERE layanan_plagiasi_id = lp.id
                    )');
            })
            ->select(
                'p.prodi',
                'p.fakultas',
                DB::raw('AVG(rp.persentase) as rata_plagiasi')
            )
            ->groupBy('p.id', 'p.prodi', 'p.fakultas')
            ->orderBy('p.fakultas')
            ->get();

        $totalRataPlagiasi = round(
            $rataPlagiasi
                ->whereNotNull('rata_plagiasi')
                ->avg('rata_plagiasi'),
            2
        );

        // ================= LIST PLAGIASI =================
        $plagiasi = Layanan_plagiasi::with('mahasiswa')
            ->whereHas('mahasiswa', function ($q) use ($angkatan, $search) {
                $q->where('angkatan', $angkatan);

                if ($search) {
                    $q->where(function ($qq) use ($search) {
                        $qq->where('nim', 'like', "%{$search}%")
                        ->orWhere('nama', 'like', "%{$search}%");
                    });
                }
            })
            ->orderByDesc('updated_at')
            ->paginate(10)
            ->withQueryString();

        // ================= RIWAYAT CEK > 1 KALI =================
        $riwayat = Riwayat_plagiasi::with('layananPlagiasi.mahasiswa')
            ->whereHas('layananPlagiasi.mahasiswa', function ($q) use ($angkatan) {
                $q->where('angkatan', $angkatan);
            })
            ->get()
            ->groupBy(fn ($item) =>
                optional($item->layananPlagiasi)->mahasiswa_id
            );

        $jumlahPutra = 0;
        $jumlahPutri = 0;
        $putra = 0;
        $putri = 0;

        foreach ($riwayat as $group) {
            if ($group->count() <= 1) continue;

            $mahasiswa = optional($group->first()->layananPlagiasi)->mahasiswa;
            if (!$mahasiswa) continue;

            $bayar = ($group->count() - 1) * 5000;

            if ($mahasiswa->jk === 'Putra') {
                $jumlahPutra++;
                $putra += $bayar;
            } elseif ($mahasiswa->jk === 'Putri') {
                $jumlahPutri++;
                $putri += $bayar;
            }
        }

        $jumlahMahasiswaAngkatan = Layanan_plagiasi::whereHas('mahasiswa', function ($q) use ($angkatan) {
        $q->where('angkatan', $angkatan);
        })
        ->distinct('mahasiswa_id')
        ->count('mahasiswa_id');


        $jumlahTotal = $jumlahPutra + $jumlahPutri;
        $totalPendapatan = $putra + $putri;

        return view(
            'admin.Layanan.cekplagiasi.index',
            compact(
                'plagiasi',
                'rataPlagiasi',
                'jumlahTotal',
                'totalPendapatan',
                'putra',
                'putri',
                'jumlahPutra',
                'jumlahPutri',
                'totalRataPlagiasi',
                'search',
                'angkatan',
                'defaultAngkatan',
                'jumlahMahasiswaAngkatan' // ⬅️ tambahkan
            )
        );
    }

    public function create()
    {
        $mahasiswa = Mahasiswa::latest()->get();
        $dosen = Dosen::latest()->get();

        return view('admin.Layanan.cekplagiasi.tambah', compact('mahasiswa', 'dosen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'prodi' => 'required',
            'file' => 'required|file|mimes:pdf,doc,docx',
        ]);

        $nim = $request->nim;

        // ==============================
        // CEK MAHASISWA
        // ==============================
        $mahasiswa = Mahasiswa::where('nim', $nim)->first();

        if ($mahasiswa) {
            $sudahAdaPlagiasi = Layanan_plagiasi::where('mahasiswa_id', $mahasiswa->id)->exists();

            if ($sudahAdaPlagiasi) {
                return back()->with('error', 'Mahasiswa ini sudah memiliki data plagiasi.');
            }
        }

        // ==============================
        // CARI PRODI
        // ==============================
        $prodi = Prodi::where('prodi', $request->prodi)->first();

        if (!$prodi) {
            return back()->withErrors([
                'prodi' => 'Prodi tidak ditemukan'
            ]);
        }

        // ==============================
        // HITUNG ANGKATAN
        // ==============================
        $angkatan = Carbon::now()->year - 4;

        // ==============================
        // SIMPAN MAHASISWA
        // ==============================
        if (!$mahasiswa) {
            $mahasiswa = Mahasiswa::create([
                'nim' => $nim,
                'angkatan' => $angkatan,
                'nama' => $request->nama,
                'prodi' => $request->prodi,
                'jk' => $request->jk,
                'prodi_id' => $prodi->id,
                'kecamatan' => $request->kecamatan,
                'kabupaten' => $request->kabupaten,
                'provinsi' => $request->provinsi,
            ]);
        }

        // ==============================
        // FORMAT NAMA FILE
        // ==============================
        $file = $request->file('file');
        $ext = $file->getClientOriginalExtension();

        $kodeProdi = $prodi->kode;
        $nama = Str::slug($mahasiswa->nama);

        $fileName = $kodeProdi . '-' . $nama . '-' . $mahasiswa->nim . '-Cek.' . $ext;

        // ==============================
        // UPLOAD FILE
        // ==============================
        $filePath = $file->storeAs(
            'cekplagiasi/tugas-akhir',
            $fileName,
            'public'
        );

        // ==============================
        // SIMPAN PLAGIASI
        // ==============================
        $plagiasi = Layanan_plagiasi::create([
            'mahasiswa_id' => $mahasiswa->id,
            'dosen_id' => $request->dosen_id,
            'dosen2_id' => $request->dosen2_id,
            'judul' => $request->judul,
            'file' => $filePath,
        ]);

        // ==============================
        // SIMPAN KE TABEL SKRIPSI
        // ==============================
        $angkatan2Digit = substr($angkatan, -2);
        $urutan = substr($mahasiswa->nim, -3);
        $label = $kodeProdi . '.' . $angkatan2Digit . '.' . $urutan;

        Skripsi::create([
            'layanan_plagiasi_id' => $plagiasi->id,
            'label' => $label,
        ]);

        return redirect('/admin/layanan-cekplagiasi')
            ->with('success', 'Data berhasil disimpan.');
    }



    public function edit($id)
    {
        $plagiasi = Layanan_plagiasi::findOrFail($id);

        $mahasiswa = Mahasiswa::latest()->get();
        $dosen = Dosen::latest()->get();

        return view('admin.Layanan.cekplagiasi.edit', compact('mahasiswa', 'dosen' , 'plagiasi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'file' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        $plagiasi = Layanan_plagiasi::findOrFail($id);

        // ==============================
        // UPDATE MAHASISWA
        // ==============================
        if ($plagiasi->mahasiswa_id) {
            $mahasiswa = Mahasiswa::find($plagiasi->mahasiswa_id);

            if ($mahasiswa) {
                $mahasiswa->nama = $request->nama;
                $mahasiswa->kecamatan = $request->kecamatan;
                $mahasiswa->kabupaten = $request->kabupaten;
                $mahasiswa->provinsi = $request->provinsi;
                $mahasiswa->save();
            }
        }

        // ==============================
        // UPDATE DATA PLAGIASI
        // ==============================
        $plagiasi->dosen_id = $request->dosen_id;
        $plagiasi->dosen2_id = $request->dosen2_id;
        $plagiasi->judul = $request->judul;

        // ==============================
        // HANDLE FILE
        // ==============================
        if ($request->hasFile('file')) {

            // hapus file lama
            if ($plagiasi->file && Storage::disk('public')->exists($plagiasi->file)) {
                Storage::disk('public')->delete($plagiasi->file);
            }

            $file = $request->file('file');
            $ext = $file->getClientOriginalExtension();

            $mahasiswa = $plagiasi->mahasiswa;
            $prodi = Prodi::find($mahasiswa->prodi_id);

            $kodeProdi = $prodi->kode ?? 'PRODI';
            $nama = Str::slug($mahasiswa->nama);

            $fileName = $kodeProdi . '-' . $nama . '-' . $mahasiswa->nim . '-Cek.' . $ext;

            // simpan ke storage
            $filePath = $file->storeAs('cekplagiasi/tugas-akhir', $fileName, 'public');

            $plagiasi->file = $filePath;
        }

        $plagiasi->save();

        return redirect('/admin/layanan-cekplagiasi')
            ->with('success', 'Data berhasil diperbarui.');
    }

    // Download file dari Google Drive
    public function download($id)
    {
        $plagiasi = Layanan_plagiasi::findOrFail($id);

        // cek apakah file ada
        if (!Storage::disk('public')->exists($plagiasi->file)) {
            abort(404, 'File tidak ditemukan');
        }

        // ambil path lengkap
        $filePath = Storage::disk('public')->path($plagiasi->file);

        // ambil nama file saja
        $fileName = basename($plagiasi->file);

        return response()->download($filePath, $fileName);
    }


    public function hasil(Request $request, $id)
    {

        $plagiasi = Layanan_plagiasi::findOrFail($id);

        // ambil mahasiswa
        $mahasiswa = Mahasiswa::findOrFail($plagiasi->mahasiswa_id);

        // ambil prodi
        $prodi = Prodi::find($mahasiswa->prodi_id);

        $kodeProdi = $prodi->kode ?? 'PRODI';
        $nama = Str::slug($mahasiswa->nama);
        $nim = $mahasiswa->nim;
        $persentase = $request->persentase;

        // file
        $file = $request->file('hasil');
        $ext = $file->getClientOriginalExtension();

        // format nama file
        $fileName = $kodeProdi . '-' . $nama . '-' . $nim . '-hasil-' . $persentase . '.' . $ext;

        // simpan ke storage
        $filePath = $file->storeAs('cekplagiasi/tugas-akhir/hasil', $fileName, 'public');

        // simpan ke riwayat
        $riwayat = Riwayat_plagiasi::create([
            'layanan_plagiasi_id' => $plagiasi->id,
            'persentase' => $persentase,
            'hasil' => $filePath
        ]);

        $dosen1 = Dosen::where('id', $plagiasi->dosen_id)->first();
        $dosen2 = Dosen::where('id', $plagiasi->dosen2_id)->first();

            $curl = curl_init();

            // Pesan ke dosen
            $pesanDosen = '_Assalamu’alaikum warahmatullahi wabarakatuh_

Yth. Bpk/Ibu Dosen Pembimbing,

Dengan ini kami informasikan bahwa Mahasiswa bimbingan Bapak/Ibu:

Nama : *'.$mahasiswa->nama.'*
Program Studi : *'.$mahasiswa->prodi.'*
Calon Lulusan : *'.$mahasiswa->angkatan + 4 .'*
Judul Skripsi : *_"'.$plagiasi->judul.'"_*

telah melakukan cek plagiasi skripsi ke-'.$plagiasi->update_count.' di Perpustakaan Ibrahimy pada '. Carbon::parse($riwayat->created_at)->isoFormat('dddd, D MMMM Y') .' dengan hasil persentase plagiasi *'.$request->persentase.'%*.

dokumen hasil cek plagiasi dapat di unduh melalui tautan berikut:
📃 https://layanan.lib.ibrahimy.ac.id/layanan-cekplagiasi/hasil/'.$riwayat->id.'

Terima kasih atas perhatian dan kerja sama Bapak/Ibu.

_Wassalamu’alaikum warahmatullahi wabarakatuh._

ⓘ _Pesan ini dikirim secara otomatis melalui Sistem Layanan Cek Plagiasi Perpustakaan Ibrahimy._
🌐 www.lib.ibrahimy.ac.id';



            // Pesan ke prodi
            $pesanProdi = '_Assalamu’alaikum warahmatullahi wabarakatuh_

Yth. Bapak/Ibu Kepala Program Studi '.$mahasiswa->prodi.',

Dengan ini kami informasikan bahwa salah satu mahasiswa dari Program Studi '.$mahasiswa->prodi.':

Nama : *'.$mahasiswa->nama.'*
Program Studi : *'.$mahasiswa->prodi.'*
Calon Lulusan : *'.$mahasiswa->angkatan + 4 .'*
Judul Skripsi : *_"'.$plagiasi->judul.'"_*

telah melakukan cek plagiasi skripsi ke-'.$plagiasi->update_count.' di Perpustakaan Ibrahimy pada '. Carbon::parse($riwayat->created_at)->isoFormat('dddd, D MMMM Y') .' dengan hasil persentase plagiasi *'.$request->persentase.'%*.

dokumen hasil cek plagiasi dapat di unduh melalui tautan berikut:
📃 https://layanan.lib.ibrahimy.ac.id/layanan-cekplagiasi/hasil/'.$riwayat->id.'

Terima kasih atas perhatian dan kerja sama Bapak/Ibu.

_Wassalamu’alaikum warahmatullahi wabarakatuh._

ⓘ _Pesan ini dikirim secara otomatis melalui Sistem Layanan Cek Plagiasi Perpustakaan Ibrahimy._
🌐 www.lib.ibrahimy.ac.id';

            $token = 'CtBuHqwhxLBH4zAPsJcn';

            // Kirim ke dosen 1
            if ($dosen1 && $dosen1->nomor) {
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.fonnte.com/send',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POSTFIELDS => array(
                        'target'  => $dosen1->nomor,
                        'message' => $pesanDosen
                    ),
                    CURLOPT_HTTPHEADER => array('Authorization: ' . $token),
                ));
                curl_exec($curl);
            }

            // Kirim ke dosen 2
            if ($dosen2 && $dosen2->nomor) {
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.fonnte.com/send',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POSTFIELDS => array(
                        'target'  => $dosen2->nomor,
                        'message' => $pesanDosen
                    ),
                    CURLOPT_HTTPHEADER => array('Authorization: ' . $token),
                ));
                curl_exec($curl);
            }

            // Kirim ke prodi jika ada
            $kontakProdi = optional($mahasiswa->programstudi)->kontak;
            if ($kontakProdi) {
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.fonnte.com/send',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POSTFIELDS => array(
                        'target'  => $kontakProdi,
                        'message' => $pesanProdi
                    ),
                    CURLOPT_HTTPHEADER => array('Authorization: ' . $token),
                ));
                curl_exec($curl);
            }

            // Tutup cURL setelah semua pengiriman selesai
            curl_close($curl);


        return back()->with('success', 'Hasil Plagiasi berhasil diupload.');

    }

    public function downloadhasil($id)
    {
        $riwayat = Riwayat_plagiasi::findOrFail($id);

        // cek file ada atau tidak
        if (!Storage::disk('public')->exists($riwayat->hasil)) {
            abort(404, 'File tidak ditemukan');
        }

        // path lengkap file
        $filePath = Storage::disk('public')->path($riwayat->hasil);

        // ambil nama file saja
        $fileName = basename($riwayat->hasil);

        return response()->download($filePath, $fileName);
    }


    public function hapushasil($id)
    {
        $riwayat = Riwayat_plagiasi::findOrFail($id);

        // hapus file dari storage
        if ($riwayat->hasil && Storage::disk('public')->exists($riwayat->hasil)) {
            Storage::disk('public')->delete($riwayat->hasil);
        }

        // hapus data
        $riwayat->delete();

        return back()->with('success', 'Riwayat Hasil berhasil dihapus');
    }

    public function uploadUlang(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx',
        ]);

        // ambil data
        $plagiasi = Layanan_plagiasi::findOrFail($id);
        $mahasiswa = Mahasiswa::find($plagiasi->mahasiswa_id);

        // ambil prodi
        $prodi = Prodi::find($mahasiswa->prodi_id);

        // hitung update ke-
        $fileCount = ($plagiasi->update_count ?? 1) + 1;

        if ($request->hasFile('file')) {

            // hapus file lama
            if ($plagiasi->file && Storage::disk('public')->exists($plagiasi->file)) {
                Storage::disk('public')->delete($plagiasi->file);
            }

            $file = $request->file('file');
            $ext = $file->getClientOriginalExtension();

            $kodeProdi = $prodi->kode ?? 'PRODI';
            $nama = Str::slug($mahasiswa->nama);
            $nim = $mahasiswa->nim;

            // format nama baru + count
            $fileName = $kodeProdi . '-' . $nama . '-' . $nim . '-Cek-' . $fileCount . '.' . $ext;

            // simpan ke storage
            $filePath = $file->storeAs('cekplagiasi/tugas-akhir', $fileName, 'public');

            // update data
            $plagiasi->file = $filePath;
            $plagiasi->update_count = $fileCount;
            $plagiasi->updated_at = now();
            $plagiasi->save();
        }

        return back()->with('success', 'File berhasil diunggah ulang.');
    }






    public function rekap(Request $request)
    {
        // default angkatan = tahun sekarang
        $defaultAngkatan = Carbon::now()->year;

        // ambil input
        $angkatan = $request->angkatan ?? $defaultAngkatan;
        $search = $request->search;

        $rataPlagiasi = DB::table('prodis as p')
            ->leftJoin('mahasiswas as m', function ($join) use ($angkatan) {
                $join->on('p.id', '=', 'm.prodi_id');

                // filter angkatan
                if ($angkatan != 'all') {
                    $join->where('m.angkatan', $angkatan);
                }
            })
            ->leftJoin('layanan_plagiasis as lp', 'm.id', '=', 'lp.mahasiswa_id')

            // ambil riwayat terakhir
            ->leftJoin('riwayat_plagiasis as rp', function ($join) {
                $join->on('lp.id', '=', 'rp.layanan_plagiasi_id')
                    ->whereRaw('rp.created_at = (
                        SELECT MAX(created_at)
                        FROM riwayat_plagiasis
                        WHERE layanan_plagiasi_id = lp.id
                    )');
            })

            ->leftJoin('riwayat_plagiasis as all_rp', 'lp.id', '=', 'all_rp.layanan_plagiasi_id')

            // FILTER SEARCH
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('m.nama', 'like', "%{$search}%")
                    ->orWhere('m.nim', 'like', "%{$search}%");
                });
            })

            ->select(
                'p.prodi as prodi',
                'p.fakultas',
                DB::raw('COALESCE(AVG(rp.persentase), 0) as rata_plagiasi'),
                DB::raw('COUNT(DISTINCT CASE WHEN all_rp.id IS NOT NULL THEN m.id END) as jumlah_mahasiswa_cek'),
                DB::raw('COUNT(DISTINCT CASE WHEN rp.persentase <= 30 THEN m.id END) as jumlah_plagiasi_ok')
            )
            ->groupBy('p.id', 'p.prodi', 'p.fakultas')
            ->orderByDesc(DB::raw('COALESCE(AVG(rp.persentase), 0)'))
            ->get();

        // rata-rata total (hanya yang ada data)
        $totalRataPlagiasi = round(
            $rataPlagiasi
                ->filter(fn($item) => $item->jumlah_mahasiswa_cek > 0)
                ->avg('rata_plagiasi'),
            2
        );

        return view('admin.Layanan.cekplagiasi.rekap', compact(
            'rataPlagiasi',
            'totalRataPlagiasi',
            'angkatan',
            'search',
            'defaultAngkatan'
        ));
    }












    public function nonTA(Request $request)
    {
        $search = $request->search;

        // Query dasar (JANGAN kena pagination)
        $baseQuery = Layanan_plagiasi::whereNull('mahasiswa_id')
            ->when($search, function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%");
            });

        // Data untuk tabel (pagination)
        $plagiasi = (clone $baseQuery)
            ->orderByDesc('updated_at')
            ->paginate(10)
            ->withQueryString();

        // Jumlah cek TOTAL (tetap, tidak terpengaruh page)
        $jumlahCek = (clone $baseQuery)->count();

        // Total biaya
        $totalBiaya = $jumlahCek * 5000;

        return view(
            'admin.Layanan.cekplagiasi.non-ta',
            compact('plagiasi', 'search', 'jumlahCek', 'totalBiaya')
        );
    }


    public function tambah(Request $request)
    {

        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx',
        ]);

         // Cek apakah mahasiswa sudah memiliki entri di layanan_plagiasis
        $existingEntry = Layanan_plagiasi::where('nama', $request->nama)->exists();

        if ($existingEntry) {
            return redirect()->back()->with('error', 'Yang bersangkutan sudah memiliki data plagiasi.');
        }

        // Buat nama file sesuai dengan NIM, nama mahasiswa, dan persentase
        $fileExtension = $request->file('file')->getClientOriginalExtension();
        $fileName = Str::slug('File_'.$request->nama) . '.' . $fileExtension;

        // Unggah file ke Google Drive
        $filePath = $request->file('file')->storeAs('', $fileName, 'google');

         // Simpan data ke database
         Layanan_plagiasi::create([
             'nama' => $request->nama,
             'judul' => $request->judul,
             'ket' => $request->ket,
             'file' => $filePath,
         ]);


        return redirect('/admin/layanan-cekplagiasi')->with('success', 'Data berhasil disimpan.');
    }



    public function perbarui(Request $request, $id)
    {
        $request->validate([
            'file' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        // Ambil data plagiasi berdasarkan ID
        $plagiasi = Layanan_plagiasi::findOrFail($id);

        // Jika ada file baru, hapus file lama dan upload yang baru
        if ($request->hasFile('file')) {
            // Hapus file lama dari Google Drive
            Storage::disk('google')->delete($plagiasi->file);

            // Buat nama file baru
            $fileExtension = $request->file('file')->getClientOriginalExtension();
            $fileName = Str::slug($plagiasi->nama) . '.' . $fileExtension;

            // Upload file baru
            $filePath = $request->file('file')->storeAs('', $fileName, 'google');

            $plagiasi->update([
                'nama' => $request->nama,
                'judul' => $request->judul,
                'ket' => $request->ket,
                'file' => $filePath
            ]);
        }else{
            $plagiasi->update([
                'nama' => $request->nama,
                'judul' => $request->judul,
                'ket' => $request->ket,
            ]);
        }

        return redirect('/admin/layanan-cekplagiasi')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $plagiasi = Layanan_plagiasi::findOrFail($id);

        // Hapus file dari Google Drive jika ada
        if ($plagiasi->file) {
            Storage::disk('google')->delete($plagiasi->file);
        }

        // Hapus data dari database
        $plagiasi->delete();

        return redirect('/admin/layanan-cekplagiasi')->with('success', 'Data berhasil dihapus!');
    }





    public function cetak($id)
    {
        $plagiasi = Layanan_plagiasi::findOrFail($id);

        $pdf = Pdf::loadView('admin.Layanan.cekplagiasi.pdf', [
            'plagiasi' => $plagiasi,
        ]);

        $pdf->setPaper('A4', 'portrait');

        $namaFile = '' .
            ($plagiasi->mahasiswa_id === null
                ? $plagiasi->nama
                : $plagiasi->mahasiswa->nama) .
            ' - SKHCP Perpustakaan Ibrahimy.pdf';

        return $pdf->stream($namaFile);
    }

    public function bebaspustaka(Request $request)
    {
        // default angkatan = tahun sekarang - 4
        $defaultAngkatan = Carbon::now()->year - 4;

        // ambil dari request atau pakai default
        $angkatan = $request->angkatan ?? $defaultAngkatan;

        // =========================
        // QUERY DATA PLAGIASI
        // =========================
        $plagiasi = Layanan_plagiasi::with('mahasiswa')
            ->when($angkatan != 'all', function ($query) use ($angkatan) {
                $query->whereHas('mahasiswa', function ($q) use ($angkatan) {
                    $q->where('angkatan', $angkatan);
                });
            })
            ->latest()
            ->get();

        // =========================
        // LIST ANGKATAN (UNTUK SELECT)
        // =========================
        $listAngkatan = Mahasiswa::select('angkatan')
            ->whereNotNull('angkatan')
            ->distinct()
            ->orderBy('angkatan', 'desc')
            ->pluck('angkatan');

        // =========================
        // STATISTIK MAHASISWA
        // =========================
        $mahasiswaQuery = Mahasiswa::query();

        if ($angkatan != 'all') {
            $mahasiswaQuery->where('angkatan', $angkatan);
        }

        $totalMahasiswa = $mahasiswaQuery->count();

        // =========================
        // RETURN VIEW
        // =========================
        return view('admin.Layanan.bebaspustaka.2021.bebaspustaka', compact(
            'plagiasi',
            'angkatan',
            'listAngkatan',
            'totalMahasiswa',
            'defaultAngkatan'
        ));
    }

    public function export(Request $request)
    {
        // Ambil filter fakultas dari request
        $fakultasFilter = $request->get('fakultas');

        // Query dengan relasi mahasiswa -> programstudi
        $query = Layanan_plagiasi::with('mahasiswa.programstudi')
            ->where('ket', 'Terverifikasi');

        if ($fakultasFilter) {
            $query->whereHas('mahasiswa.programstudi', function ($q) use ($fakultasFilter) {
                $q->where('fakultas', $fakultasFilter);
            });
        }

        $plagiasi = $query->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Pemberkasan 2025');

        // Header
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Mahasiswa');
        $sheet->setCellValue('C1', 'NIM');
        $sheet->setCellValue('D1', 'Prodi');
        $sheet->setCellValue('E1', 'Fakultas');
        $sheet->setCellValue('F1', 'Judul Skripsi');

        $sheet->getStyle('A1:F1')->applyFromArray([
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
            'fill' => [
                'fillType'   => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FFDDDDDD'],
            ],
        ]);

        // Isi data
        $row = 2;
        $no = 1;
        foreach ($plagiasi as $item) {
            $mahasiswa   = $item->mahasiswa;
            $programstudi = $mahasiswa?->programstudi;
            $prodi       = $programstudi?->prodi ?? '-';
            $fakultas    = $programstudi?->fakultas ?? '-';

            $sheet->setCellValue('A'.$row, $no++);
            $sheet->setCellValue('B'.$row, $mahasiswa->nama ?? '-');
            $sheet->setCellValue('C'.$row, $mahasiswa->nim ?? '-');
            $sheet->setCellValue('D'.$row, $prodi);
            $sheet->setCellValue('E'.$row, $fakultas);
            $sheet->setCellValue('F'.$row, $item->judul ?? '-');

            $row++;
        }

        foreach (range('A', 'F') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Penamaan file, jika ada filter fakultas
        $fileFakultas = $fakultasFilter ? '_'.str_replace(' ', '_', strtolower($fakultasFilter)) : '';
        $fileName = 'pemberkasan_2025'.$fileFakultas.'.xlsx';

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"{$fileName}\"");
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }


    public function jumlah(Request $request)
    {
        // default sama seperti halaman utama
        $defaultAngkatan = Carbon::now()->year - 4;
        $angkatan = $request->angkatan ?? $defaultAngkatan;

        $rekap = Layanan_plagiasi::where('ket', 'Terverifikasi')
            ->whereHas('mahasiswa.programstudi')
            ->with('mahasiswa.programstudi')
            ->when($angkatan != 'all', function ($query) use ($angkatan) {
                $query->whereHas('mahasiswa', function ($q) use ($angkatan) {
                    $q->where('angkatan', $angkatan);
                });
            })
            ->get()
            ->groupBy(fn($item) => $item->mahasiswa->programstudi->fakultas ?? 'Tanpa Fakultas')
            ->map(function ($groupByFakultas) {
                return $groupByFakultas
                    ->groupBy(fn($item) => $item->mahasiswa->programstudi->prodi ?? 'Tanpa Prodi')
                    ->map(fn($groupByProdi) => $groupByProdi->count());
            });

        return view('admin.Layanan.bebaspustaka.2021.jumlah', compact(
            'rekap',
            'angkatan'
        ));
    }




    public function verifikasi($id)
    {
        $plagiasi = Layanan_plagiasi::findOrFail($id);

        return view('admin.Layanan.bebaspustaka.2021.verifikasi', compact('plagiasi'));
    }


    public function verified(Request $request, $id)
    {
        $plagiasi = Layanan_plagiasi::findOrFail($id);

        // Nonaktifkan update timestamp sementara
        $plagiasi->timestamps = false;

        $plagiasi->update([
            'ket' => $request->verifikasi,
        ]);

        return back()->with('success', 'Alhamdulillah, dokumen berhasil diverifikasi');
    }

    public function kirim(Request $request, $id)
    {

        $plagiasi = Layanan_plagiasi::findOrFail($id);

        // Nonaktifkan update timestamp sementara
        $plagiasi->timestamps = false;

        $plagiasi->update([
            'ket' => 'Permohonan Terkirim',
        ]);

        $token = 'CtBuHqwhxLBH4zAPsJcn';

        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.fonnte.com/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
            'target'  => '081353669222',
            'message' =>
        'Assalamu’alaikum warahmatullahi wabarakatuh!

        Yth. Bpk. Muhammad Ali Ridla, M.Kom,

        Mahasiswa calon lulusan '. $request->angkatan + 4 . ' atas nama ' . $request->nama . ' saat ini sedang menunggu verifikasi tanda tangan elektronik untuk _Surat Keterangan Bebas Pustaka_.
        Kami mohon kesediaan Anda untuk melakukan verifikasi melalui tautan berikut:
        🌐 https://layanan.lib.ibrahimy.ac.id/layanan-ketbebaspustaka='.$request->id.'/verifikasi
        Terima kasih atas perhatian dan kerja samanya.

        Wassalamu’alaikum warahmatullahi wabarakatuh.'
        ),
        CURLOPT_HTTPHEADER => array(
            'Authorization: ' . $token
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return back()->with('success', 'Permohonan verifikasi telah dikirim');
    }

    public function cetak_ket($id)
    {
        $plagiasi = Layanan_plagiasi::findOrFail($id);

        $pdf = Pdf::loadView('admin.Layanan.bebaspustaka.2021.cetak', [
            'plagiasi' => $plagiasi,
        ]);

        // Bersihkan nama dari karakter ilegal untuk nama file
        $namaFile = preg_replace('/[^A-Za-z0-9\- ]/', '', $plagiasi->mahasiswa->nama) . '_SKBP Perpustakaan Ibrahimy.pdf';

        $pdf->setPaper('A4', 'potrait');
        return $pdf->stream($namaFile);
    }

    public function cetak_per($id)
    {
        $plagiasi = Layanan_plagiasi::findOrFail($id);

        $pdf = Pdf::loadView('admin.Layanan.bebaspustaka.2021.pernyataan', [
            'plagiasi' => $plagiasi,
        ]);

        // Bersihkan nama dari karakter ilegal untuk nama file
        $namaFile = preg_replace('/[^A-Za-z0-9\- ]/', '', $plagiasi->mahasiswa->nama) . '_SKBP Perpustakaan Ibrahimy.pdf';

        $pdf->setPaper('A4', 'potrait');
        return $pdf->stream($namaFile);
    }







}
