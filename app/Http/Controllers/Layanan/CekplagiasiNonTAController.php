<?php

namespace App\Http\Controllers\Layanan;

use App\Http\Controllers\Controller;
use App\Models\Layanan\Layanan_plagiasinonta;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CekplagiasiNonTAController extends Controller
{
    //
    public function index(Request $request)
    {
        // TOTAL CEK (sum update_count)
        $jumlahCek = Layanan_plagiasinonta::sum('update_count');

        // TOTAL PENDAPATAN
        $totalPendapatan = $jumlahCek * 5000;

        // PENDAPATAN PER PETUGAS
        $pendapatanPerPetugas = Layanan_plagiasinonta::selectRaw('petugas, SUM(update_count) as total')
            ->groupBy('petugas')
            ->pluck('total', 'petugas')
            ->map(fn($item) => $item * 5000);

        // FILTER BULAN (default bulan ini)
        $bulan = $request->bulan ?? now()->month;
        $tahun = $request->tahun ?? now()->year;

        // PENDAPATAN PER PETUGAS PER BULAN
        $pendapatanPerPetugasBulanan = Layanan_plagiasinonta::whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->selectRaw('petugas, SUM(update_count) as total')
            ->groupBy('petugas')
            ->pluck('total', 'petugas')
            ->map(fn($item) => $item * 5000);

        $nonta = Layanan_plagiasinonta::latest()->get();

        return view('admin.Layanan.cekplagiasi.nonta.index', compact(
            'nonta',
            'jumlahCek',
            'totalPendapatan',
            'pendapatanPerPetugas',
            'pendapatanPerPetugasBulanan'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'judul' => 'required',
            'file' => 'required|file|mimes:pdf,doc,docx',
        ]);

        $file = $request->file('file');
        $ext = $file->getClientOriginalExtension();

        $nama = Str::slug($request->nama);

        $fileName = 'cek-' . $nama . '-' .  time() . '.' . $ext;

        $filePath = $file->storeAs('cekplagiasi/non-tugas-akhir', $fileName, 'public');

        Layanan_plagiasinonta::create([
            'nama' => $request->nama,
            'ket' => $request->ket,
            'kontak' => $request->kontak,
            'petugas' => $request->petugas,
            'judul' => $request->judul,
            'file' => $filePath,
            'hasil' => null,
            'persentase' => null,
            'update_count' => 1,
        ]);

        return back()->with('success', 'Data berhasil ditambahkan');
    }

    public function download($id)
    {
        $data = Layanan_plagiasinonta::findOrFail($id);

        if (!Storage::disk('public')->exists($data->file)) {
            abort(404);
        }

        return response()->download(
            Storage::disk('public')->path($data->file),
            basename($data->file)
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'judul' => 'required',
            'file' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        $data = Layanan_plagiasinonta::findOrFail($id);

        // update data basic
        $data->nama = $request->nama;
        $data->ket = $request->ket;
        $data->kontak = $request->kontak;
        $data->petugas = $request->petugas;
        $data->judul = $request->judul;

        // jika upload file baru
        if ($request->hasFile('file')) {

            // hapus file lama
            if ($data->file && Storage::disk('public')->exists($data->file)) {
                Storage::disk('public')->delete($data->file);
            }

            $file = $request->file('file');
            $ext = $file->getClientOriginalExtension();

            $nama = Str::slug($request->nama);

            $fileName = 'cek' . $nama . '-' . time() . '.' . $ext;

            $filePath = $file->storeAs('cekplagiasi/non-tugas-akhir', $fileName, 'public');

            $data->file = $filePath;
        }

        $data->save();

        return back()->with('success', 'Data berhasil diperbarui');
    }

    public function hasil(Request $request, $id)
    {
        $request->validate([
            'persentase' => 'required|numeric|min:0|max:100',
            'hasil' => 'required|file|mimes:pdf,doc,docx',
        ]);

        $data = Layanan_plagiasinonta::findOrFail($id);

        // hapus file hasil lama (jika ada)
        if ($data->hasil && Storage::disk('public')->exists($data->hasil)) {
            Storage::disk('public')->delete($data->hasil);
        }

        $file = $request->file('hasil');
        $ext = $file->getClientOriginalExtension();

        $nama = Str::slug($data->nama);
        $persentase = $request->persentase;

        // format nama file
        $fileName = 'hasil-' . $nama . '-' . $persentase . '-' . time() . '.' . $ext;

        // simpan ke storage
        $filePath = $file->storeAs('cekplagiasi/non-tugas-akhir/hasil', $fileName, 'public');

        // update data
        $data->hasil = $filePath;
        $data->persentase = $persentase;
        $data->save();

        // ==============================
        // KIRIM WHATSAPP KE KONTAK USER
        // ==============================
        if ($data->kontak) {

            // format nomor (ubah 08 jadi 628)
            $target = preg_replace('/^0/', '62', $data->kontak);

            $linkDownload = url('storage/' . $data->hasil);

            $pesan = '_Assalamu’alaikum warahmatullahi wabarakatuh_

Dengan ini kami informasikan bahwa hasil pengecekan plagiasi dokumen dengan rincian: 

Nama : *"'.$data->nama.'"* 
Keterangan : *"'.$data->ket.'"* 
Judul : *"'.$data->judul.'"* 
Tingkat Plagiasi : *"'.$persentase.'%"* 

Silakan unduh dokumen hasil melalui tautan berikut:
📄 '.$linkDownload.'

Dokumen keterangan resmi hasil cek plagiasi dari Perpustakaan juga dapat diunduh pada tautan berikut:
📑 https://layanan.lib.ibrahimy.ac.id/hasilplagiasi='.$data->id.'

Terima kasih telah menggunakan layanan kami.

_Wassalamu’alaikum warahmatullahi wabarakatuh._

ⓘ _Pesan ini dikirim otomatis oleh Sistem Layanan Cek Plagiasi_';

            $token = 'CtBuHqwhxLBH4zAPsJcn';

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POSTFIELDS => array(
                    'target'  => $target,
                    'message' => $pesan
                ),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: ' . $token
                ),
            ));

            curl_exec($curl);
            curl_close($curl);
        }

        return back()->with('success', 'Hasil berhasil diupload');
    }

    public function uploadUlangDoc(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx',
        ]);

        $data = Layanan_plagiasinonta::findOrFail($id);

        // hapus file lama
        if ($data->file && Storage::disk('public')->exists($data->file)) {
            Storage::disk('public')->delete($data->file);
        }

        // hapus file hasil (reset)
        if ($data->hasil && Storage::disk('public')->exists($data->hasil)) {
            Storage::disk('public')->delete($data->hasil);
        }

        // update count +1
        $updateCount = ($data->update_count ?? 1) + 1;

        $file = $request->file('file');
        $ext = $file->getClientOriginalExtension();

        $nama = Str::slug($data->nama);

        // format nama file: nama-keX-timestamp.ext
        $fileName = $nama . '-cek-ke-' . $updateCount . '-' . time() . '.' . $ext;

        // simpan ke storage
        $filePath = $file->storeAs('cekplagiasi/non-tugas-akhir', $fileName, 'public');

        // update data
        $data->file = $filePath;
        $data->hasil = null; // reset hasil
        $data->persentase = null; // reset persentase
        $data->update_count = $updateCount;
        $data->save();

        return back()->with('success', 'Dokumen berhasil diupload ulang.');
    }

    public function cetak($id)
    {
        $data = Layanan_plagiasinonta::findOrFail($id);

        // ambil hasil terakhir (kalau ada)
        $persentase = $data->persentase ?? '-';

        // tanggal
        $tanggal = Carbon::parse($data->updated_at)->isoFormat('D MMMM Y');

        // load view PDF
        $pdf = Pdf::loadView('admin.Layanan.cekplagiasi.nonta.ket', [
            'data' => $data,
            'persentase' => $persentase,
            'tanggal' => $tanggal,
        ])->setPaper('A4', 'portrait');

        return $pdf->stream('keterangan-plagiasi-'.$data->nama.'.pdf');
    }

    public function destroy($id)
    {
        $data = Layanan_plagiasinonta::findOrFail($id);

        // hapus file dokumen utama
        if ($data->file && Storage::disk('public')->exists($data->file)) {
            Storage::disk('public')->delete($data->file);
        }

        // hapus file hasil (jika ada)
        if ($data->hasil && Storage::disk('public')->exists($data->hasil)) {
            Storage::disk('public')->delete($data->hasil);
        }

        // hapus data
        $data->delete();

        return back()->with('success', 'Data berhasil dihapus.');
    }



}
