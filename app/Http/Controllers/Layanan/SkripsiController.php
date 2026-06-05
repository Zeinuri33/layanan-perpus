<?php

namespace App\Http\Controllers\Layanan;

use App\Http\Controllers\Controller;
use App\Models\Layanan\Layanan_plagiasi;
use App\Models\Layanan\Skripsi;
use App\Models\Prodi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SkripsiController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Skripsi::with('prodi');

        // ======================
        // SEARCH
        // ======================
        if ($request->filled('search')) {

            $search = trim($request->search);

            $query->where(function ($q) use ($search) {

                $q->where('pengarang', 'LIKE', "%{$search}%")
                ->orWhere('nim', 'LIKE', "%{$search}%")
                ->orWhere('judul', 'LIKE', "%{$search}%")
                ->orWhere('label', 'LIKE', "%{$search}%");

            });
        }

        // ======================
        // FILTER PRODI
        // ======================
        if ($request->filled('prodi')) {

            $query->where('prodi_id', $request->prodi);

        }

        // ======================
        // FILTER LULUSAN
        // ======================
        if ($request->filled('lulusan')) {

            $query->where('lulusan', $request->lulusan);

        }

        // ======================
        // ORDER
        // ======================
        $skripsis = $query
            ->orderByDesc('lulusan')
            ->orderBy('prodi_id')
            ->orderBy('label')
            ->paginate(10)
            ->withQueryString();

        $prodi = Prodi::all();

        return view('admin.Layanan.skripsi.index', compact(
            'skripsis',
            'prodi'
        ));
    }

    public function latest(Request $request)
    {
        $query = Layanan_plagiasi::with([
            'mahasiswa.programstudi',
            'riwayatPlagiasi'
        ])
        ->whereNotNull('mahasiswa_id')

        // join mahasiswa untuk sorting
        ->join('mahasiswas', 'layanan_plagiasis.mahasiswa_id', '=', 'mahasiswas.id')

        // penting
        ->select('layanan_plagiasis.*');

        // =========================
        // SEARCH
        // =========================
        if ($request->search) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('judul', 'like', "%{$search}%")

                ->orWhereHas('mahasiswa', function ($m) use ($search) {

                    $m->where('nama', 'like', "%{$search}%")
                    ->orWhere('nim', 'like', "%{$search}%");

                });

            });
        }

        // =========================
        // FILTER PRODI
        // =========================
        if ($request->prodi) {

            $query->where('mahasiswas.prodi_id', $request->prodi);

        }

        // =========================
        // FILTER LULUSAN
        // =========================
        if ($request->lulusan) {

            $angkatan = $request->lulusan - 4;

            $query->where('mahasiswas.angkatan', $angkatan);

        }

        // =========================
        // ORDER
        // =========================
        $plagiasi = $query
            ->orderByDesc('mahasiswas.angkatan')
            ->orderBy('mahasiswas.prodi_id')
            ->orderBy('mahasiswas.nama')
            ->paginate(10)
            ->withQueryString();

        $prodi = Prodi::all();

        return view(
            'admin.Layanan.skripsi.2025.index',
            compact('plagiasi', 'prodi')
        );
    }


    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        Skripsi::create([
            'lulusan' => $request->lulusan,
            'label' => $request->label,
            'nim' => $request->nim,
            'pengarang' => $request->pengarang,
            'judul' => $request->judul,
            'prodi_id' => $request->prodi_id
        ]);

        return back()->with('success', 'Data skripsi berhasil ditambahkan.');
    }

    public function import(Request $request)
    {
        $validated = $request->validate([
            'layanan_plagiasi_id' => 'required|exists:layanan_plagiasis,id',
        ]);

        // =========================
        // AMBIL DATA PLAGIASI
        // =========================
        $plagiasi = Layanan_plagiasi::with('mahasiswa.programstudi')
            ->findOrFail($request->layanan_plagiasi_id);

        $mahasiswa = $plagiasi->mahasiswa;

        if (!$mahasiswa) {
            return back()->with('error', 'Mahasiswa tidak ditemukan.');
        }

        // =========================
        // DATA LABEL
        // =========================
        $angkatan = Carbon::now()->year - 4;
        $angkatan2Digit = substr($angkatan, -2);
        $urutan = substr($mahasiswa->nim, -3);
        $kodeProdi = $mahasiswa->programstudi?->kode ?? 'UNK';
        $label = $kodeProdi . '.' . $angkatan2Digit . '.' . $urutan;

        // =========================
        // SIMPAN SKRIPSI
        // =========================
        Skripsi::create([
            'layanan_plagiasi_id' => $plagiasi->id,
            'label' => $label,
        ]);

        return back()->with('success', 'Data skripsi berhasil ditambahkan dari data plagiasi.');
    }

    public function update(Request $request, $id)
    {
        $skripsi = Skripsi::findOrFail($id);

        $skripsi->update([
            'lulusan' => $request->lulusan,
            'label' => $request->label,
            'nim' => $request->nim,
            'pengarang' => $request->pengarang,
            'judul' => $request->judul,
            'prodi_id' => $request->prodi_id,
        ]);

        return back()->with('success', 'Data skripsi berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $skripsi = Skripsi::findOrFail($id);

        $skripsi->delete();

        return redirect()->back()->with('success', 'Data skripsi berhasil dihapus.');
    }

    public function katalog(Request $request)
    {
        $search = trim($request->search);

        // ==================================================
        // DATA SKRIPSI MANUAL (TABEL SKRIPSIS)
        // ==================================================
        $skripsi = Skripsi::with('prodi')

            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where('judul', 'LIKE', "%{$search}%")
                    ->orWhere('pengarang', 'LIKE', "%{$search}%")
                    ->orWhere('nim', 'LIKE', "%{$search}%")
                    ->orWhere('label', 'LIKE', "%{$search}%");

                });

            })

            ->get()

            ->map(function ($item) {

                return [
                    'sumber' => 'skripsi',
                    'judul' => $item->judul,
                    'pengarang' => $item->pengarang,
                    'nim' => $item->nim,
                    'label' => $item->label,
                    'lulusan' => $item->lulusan,
                    'prodi' => $item->prodi?->prodi,
                    'kode_prodi' => $item->prodi?->kode,
                    'fakultas' => $item->prodi?->fakultas,
                    'plagiasi' => null,
                ];
            });

        // ==================================================
        // DATA SKRIPSI DARI LAYANAN PLAGIASI
        // ==================================================
        $plagiasi = Layanan_plagiasi::with([
                'mahasiswa.programstudi',
                'riwayatPlagiasi'
            ])

            ->whereNotNull('mahasiswa_id')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('judul', 'LIKE', "%{$search}%")
                    ->orWhereHas('mahasiswa', function ($m) use ($search) {
                        $m->where('nama', 'LIKE', "%{$search}%")
                        ->orWhere('nim', 'LIKE', "%{$search}%");
                    });
                });
            })

            ->get()

            ->map(function ($item) {

                return [
                    'sumber' => 'plagiasi',
                    'judul' => $item->judul,
                    'pengarang' => $item->mahasiswa?->nama,
                    'nim' => $item->mahasiswa?->nim,
                    'label' =>
                        $item->mahasiswa?->programstudi?->kode . '.' .
                        substr(($item->mahasiswa?->angkatan + 4), -2) . '.' .
                        substr($item->mahasiswa?->nim, -3),
                    'lulusan' => $item->mahasiswa?->angkatan + 4,
                    'prodi' => $item->mahasiswa?->programstudi?->prodi,
                    'kode_prodi' => $item->mahasiswa?->programstudi?->kode,
                    'fakultas' => $item->mahasiswa?->programstudi?->fakultas,
                    'plagiasi' => optional(
                        $item->riwayatPlagiasi->last()
                    )->persentase,
                ];
            });

        // ==================================================
        // GABUNGKAN
        // ==================================================
        $hasil = $skripsi
            ->concat($plagiasi)

            // urut lulusan terbaru
            ->sortBy([
                ['lulusan', 'desc'],
                ['prodi', 'asc'],
                ['pengarang', 'asc'],
            ])

            ->values();
        
        $prodi = Prodi::all();

        return view('katalog-skripsi', compact('hasil', 'search' , 'prodi'));
    }
}



