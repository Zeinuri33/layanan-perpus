<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Layanan\Layanan_kartu;
use App\Models\Layanan\Layanan_plagiasi;
use App\Models\Layanan\Riwayat_plagiasi;
use App\Models\Layanan\Kasir\Transaksi_details;
use App\Models\Mahasiswa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $bulan  = $request->input('bulan', now()->month);
        $tahun  = $request->input('tahun', now()->year);

        $tanggalSekarang = Carbon::create($tahun, $bulan, 1);
        $tanggalSebelumnya = $tanggalSekarang->copy()->subMonth();

        $baseQuery = Layanan_kartu::whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun);

        // =========================
        // 🔹 STATISTIK KARTU
        // =========================
        $jumlahMahasiswaBaru = (clone $baseQuery)
            ->where('kategori', 'Mahasiswa Baru')
            ->count();

        $jumlahCetakUlang = (clone $baseQuery)
            ->where('kategori', 'Perpanjang/Cetak Ulang')
            ->count();

        $jumlahAnggotaBaru = (clone $baseQuery)
            ->where('kategori', 'Anggota Baru')
            ->count();

        $jumlahSelesai = (clone $baseQuery)
            ->where('ket', 'Selesai')
            ->count();

        $harga = [
            'Mahasiswa Baru'         => 0,
            'Perpanjang/Cetak Ulang' => 10000,
            'Anggota Baru'           => 20000,
        ];

        $pendapatan =
            ($jumlahCetakUlang * $harga['Perpanjang/Cetak Ulang']) +
            ($jumlahAnggotaBaru * $harga['Anggota Baru']);

        // =========================
        // 🔥 PERBANDINGAN BULAN
        // =========================
        $baseQueryPrev = Layanan_kartu::whereMonth('created_at', $tanggalSebelumnya->month)
            ->whereYear('created_at', $tanggalSebelumnya->year);

        $jumlahCetakUlangPrev = (clone $baseQueryPrev)
            ->where('kategori', 'Perpanjang/Cetak Ulang')
            ->count();

        $jumlahAnggotaBaruPrev = (clone $baseQueryPrev)
            ->where('kategori', 'Anggota Baru')
            ->count();

        $pendapatanSebelumnya =
            ($jumlahCetakUlangPrev * $harga['Perpanjang/Cetak Ulang']) +
            ($jumlahAnggotaBaruPrev * $harga['Anggota Baru']);

        if ($pendapatanSebelumnya > 0) {
            $persen = (($pendapatan - $pendapatanSebelumnya) / $pendapatanSebelumnya) * 100;
        } else {
            $persen = $pendapatan > 0 ? 100 : 0;
        }

        $persen = round($persen, 1);
        $status = $persen >= 0 ? 'naik' : 'turun';

        // =========================
        // 🔥 TAMBAHAN ANGKATAN
        // =========================
        $defaultAngkatan = Carbon::now()->year - 4;
        $angkatan = $request->input('angkatan', $defaultAngkatan);

        $mahasiswaQuery = Mahasiswa::query();

        if ($angkatan != 'all') {
            $mahasiswaQuery->where('angkatan', $angkatan);
        }

        $totalMahasiswa = $mahasiswaQuery->count();

        if ($angkatan != 'all') {
            $angkatanSebelumnya = $angkatan - 1;

            $totalMahasiswaPrev = Mahasiswa::where('angkatan', $angkatanSebelumnya)->count();

            if ($totalMahasiswaPrev > 0) {
                $persenMahasiswa = (($totalMahasiswa - $totalMahasiswaPrev) / $totalMahasiswaPrev) * 100;
            } else {
                $persenMahasiswa = $totalMahasiswa > 0 ? 100 : 0;
            }

            $persenMahasiswa = round($persenMahasiswa, 1);
            $statusMahasiswa = $persenMahasiswa >= 0 ? 'naik' : 'turun';
        } else {
            $persenMahasiswa = 0;
            $statusMahasiswa = 'netral';
        }

        // =========================
        // 🔥 TAMBAHAN PLAGIASI
        // =========================
        $plagiasi = Layanan_plagiasi::with('mahasiswa')
            ->when($angkatan != 'all', function ($query) use ($angkatan) {
                $query->whereHas('mahasiswa', function ($q) use ($angkatan) {
                    $q->where('angkatan', $angkatan);
                });
            })
            ->get();

        $terverifikasi = $plagiasi
            ->where('ket', '=', 'Terverifikasi')
            ->whereNotNull('mahasiswa_id')
            ->count();
        

        if ($angkatan != 'all') {
            $angkatanSebelumnya = $angkatan - 1;

            $plagiasiPrev = Layanan_plagiasi::with('mahasiswa')
                ->whereHas('mahasiswa', function ($q) use ($angkatanSebelumnya) {
                    $q->where('angkatan', $angkatanSebelumnya);
                })
                ->get();

            $jumlahPlagiasiPrev = $plagiasiPrev
                ->where('ket', '=', 'Terverifikasi')
                ->whereNotNull('mahasiswa_id')
                ->count();

            if ($jumlahPlagiasiPrev > 0) {
                $persenPlagiasi = (($terverifikasi - $jumlahPlagiasiPrev) / $jumlahPlagiasiPrev) * 100;
            } else {
                $persenPlagiasi = $terverifikasi > 0 ? 100 : 0;
            }

            $persenPlagiasi = round($persenPlagiasi, 1);

            // plagiasi naik = buruk
            $statusPlagiasi = $persenPlagiasi >= 0 ? 'naik' : 'turun';

        } else {
            $persenPlagiasi = 0;
            $statusPlagiasi = 'netral';
        }

        // =========================
        // 🔥 PENDAPATAN CEK PLAGIASI
        // =========================
        $riwayat = Riwayat_plagiasi::with('layananPlagiasi.mahasiswa')
            ->when($angkatan != 'all', function ($query) use ($angkatan) {
                $query->whereHas('layananPlagiasi.mahasiswa', function ($q) use ($angkatan) {
                    $q->where('angkatan', $angkatan);
                });
            })
            ->get()
            ->groupBy(fn ($item) =>
                optional($item->layananPlagiasi)->mahasiswa_id
            );

        $totalPendapatanPlagiasi = 0;

        foreach ($riwayat as $group) {
            if ($group->count() <= 1) continue;

            $bayar = ($group->count() - 1) * 5000;
            $totalPendapatanPlagiasi += $bayar;
        }

        if ($angkatan != 'all') {

            $angkatanSebelumnya = $angkatan - 1;

            $riwayatPrev = Riwayat_plagiasi::with('layananPlagiasi.mahasiswa')
                ->whereHas('layananPlagiasi.mahasiswa', function ($q) use ($angkatanSebelumnya) {
                    $q->where('angkatan', $angkatanSebelumnya);
                })
                ->get()
                ->groupBy(fn ($item) =>
                    optional($item->layananPlagiasi)->mahasiswa_id
                );

            $totalPendapatanPrev = 0;

            foreach ($riwayatPrev as $group) {
                if ($group->count() <= 1) continue;

                $bayar = ($group->count() - 1) * 5000;
                $totalPendapatanPrev += $bayar;
            }

            // 🔥 hitung persen
            if ($totalPendapatanPrev > 0) {
                $persenPendapatanPlagiasi =
                    (($totalPendapatanPlagiasi - $totalPendapatanPrev) / $totalPendapatanPrev) * 100;
            } else {
                $persenPendapatanPlagiasi = $totalPendapatanPlagiasi > 0 ? 100 : 0;
            }

            $persenPendapatanPlagiasi = round($persenPendapatanPlagiasi, 1);

            // naik = bagus (pendapatan)
            $statusPendapatanPlagiasi = $persenPendapatanPlagiasi >= 0 ? 'naik' : 'turun';

        } else {
            $persenPendapatanPlagiasi = 0;
            $statusPendapatanPlagiasi = 'netral';
        }

        $jumlahDosen = Dosen::count(); 
        $dosen = Dosen::latest()->take(5)->get();

        // PENDAPATAN KASIR (HARIAN & BULANAN)

        $kasirList = ['Putra', 'Putri', 'FIK', 'FSEI'];

        // 🔹 DEFAULT: BULAN INI
        $pendapatanKasirBulanan = [];

        // 🔹 DEFAULT: HARI INI
        $pendapatanKasirHarian = [];

        foreach ($kasirList as $kasir) {

            // ================= BULAN INI =================
            $queryBulanan = Transaksi_details::with('transaksi')
                ->whereHas('transaksi', function ($q) use ($kasir) {
                    $q->where('kasir', $kasir);
                })
                ->whereMonth('created_at', $bulan)
                ->whereYear('created_at', $tahun);

            $pendapatanKasirBulanan[$kasir] = $queryBulanan->sum('subtotal');


            // ================= HARI INI =================
            $queryHarian = Transaksi_details::with('transaksi')
                ->whereHas('transaksi', function ($q) use ($kasir) {
                    $q->where('kasir', $kasir);
                })
                ->whereDate('created_at', now());

            $pendapatanKasirHarian[$kasir] = $queryHarian->sum('subtotal');
        }

        return view('admin.home', compact(
            'bulan',
            'tahun',
            'jumlahMahasiswaBaru',
            'jumlahCetakUlang',
            'jumlahAnggotaBaru',
            'jumlahSelesai',
            'pendapatan',
            'persen',
            'status',

            // mahasiswa
            'angkatan',
            'totalMahasiswa',
            'persenMahasiswa',
            'statusMahasiswa',
            'terverifikasi',

            // plagiasi
            'persenPlagiasi',
            'statusPlagiasi',
            'totalPendapatanPlagiasi',
            'persenPendapatanPlagiasi',
            'statusPendapatanPlagiasi',

            //dosen
            'jumlahDosen',
            'dosen',

            //kasir
            'pendapatanKasirBulanan',
            'pendapatanKasirHarian',
        ));
    }


}
