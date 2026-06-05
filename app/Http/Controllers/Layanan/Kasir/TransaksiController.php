<?php

namespace App\Http\Controllers\Layanan\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Layanan\Kasir\Produk;
use App\Models\Layanan\Kasir\Transaksi;
use App\Models\Layanan\Kasir\Transaksi_details;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    //
    public function index(Request $request)
    {
        $query = Transaksi::with('details.produk')->latest();

        // Filter tanggal
        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }
        // Filter bulan & tahun
        elseif ($request->filled('bulan')) {
            $query->whereMonth('created_at', $request->bulan)
                ->whereYear('created_at', $request->tahun ?? now()->year);
        }

        // ✅ Filter kasir jika dipilih
        if ($request->filled('kasir')) {
            $query->where('kasir', $request->kasir);
        }

        $transaksi = $query->get();
        $produks = Produk::where('stok', 'Ada')->get();

        return view('admin.Layanan.kasir.transaksi.index', compact('transaksi', 'produks'));
    }


    
    public function store(Request $request)
    {
        // ✅ Cek apakah ada produk yang dipilih
        $produk_ids = $request->produk_id ?? [];
        $valid_produk_ids = array_filter($produk_ids, fn($val) => !empty($val));

        if (count($valid_produk_ids) < 1) {
            return back()->with('error', 'Minimal pilih satu produk yang valid.');
        }

        // ✅ Ambil dan bersihkan data
        $subtotals = array_map(fn($val) => (int) str_replace('.', '', $val), $request->subtotal);
        $uang_dibayar = (int) str_replace('.', '', $request->uang_dibayar);
        $potongan = (int) str_replace('.', '', $request->potongan ?? 0);

        $total_harga = array_sum($subtotals);
        $total_setelah_potongan = max(0, $total_harga - $potongan);

        // ✅ Hitung donasi otomatis
        $mod = $total_harga % 500;
        $donasi = 0;
        if ($mod > 0) {
            $selisih = 500 - $mod;
            if ($selisih < 300) {
                $donasi = $selisih;
            }
        }

        $uang_kembalian = $uang_dibayar - ($total_setelah_potongan + $donasi);

        $tempat = auth()->user()->tempat;
        $kasir = match ($tempat) {
            'Putra' => 'Putra',
            'Putri' => 'Putri',
            'FIK' => 'FIK',
            'FSEI' => 'FSEI',
            default => 'Unknown'
        };

        if ($uang_dibayar < ($total_setelah_potongan + $donasi)) {
            return back()->with('error', 'Uang dibayar tidak mencukupi total pembayaran.');
        }

        // ✅ Buat transaksi utama
        $transaksi = Transaksi::create([
            'kasir' => $kasir,
            'total_harga' => $total_setelah_potongan,
            'potongan' => $potongan,
            'donasi' => $donasi,
            'uang_dibayar' => $uang_dibayar,
            'uang_kembalian' => $uang_kembalian,
        ]);

        // ✅ Buat detail per produk
        foreach ($produk_ids as $i => $produkId) {
            if (empty($produkId)) continue; // Lewati jika tidak valid

            Transaksi_details::create([
                'transaksi_id' => $transaksi->id,
                'produk_id' => $produkId,
                'qty' => $request->qty[$i] ?? 1,
                'subtotal' => $subtotals[$i] ?? 0,
            ]);
        }

        return back()->with('cetak', $transaksi->id);
    }


    public function cetak($id)
    {
         $transaksi = Transaksi::with('details.produk')->findOrFail($id);
        return view('admin.Layanan.kasir.transaksi.nota', compact('transaksi'));
    }


    public function hapus($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        // Hapus detail dulu untuk menjaga integritas relasi
        $transaksi->details()->delete();

        // Hapus transaksi utama
        $transaksi->delete();

        return back()->with('success', 'Transaksi berhasil dihapus.');
    }


    public function laporan(Request $request)
    {
        $tanggal = $request->tanggal;
        $bulan = $request->bulan;
        $tahun = $request->tahun ?? now()->year;
        $kasir = $request->kasir;

        $query = Transaksi_details::with(['produk', 'transaksi']);

        // Filter tanggal
        if ($tanggal) {
            $query->whereDate('created_at', $tanggal);
        } elseif ($bulan) {
            $query->whereMonth('created_at', $bulan)
                ->whereYear('created_at', $tahun);
        } else {
            $query->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year);
        }

        // ✅ Pindahkan filter kasir ke sini sebelum get()
        if ($kasir) {
            $query->whereHas('transaksi', function ($q) use ($kasir) {
                $q->where('kasir', $kasir);
            });
        }

        $details = $query->get();

        $data = [];

        // ✅ Produk dengan kategori
        $groupedByKategori = $details->filter(function ($item) {
            return $item->produk && $item->produk->kategori;
        })->groupBy(fn($item) => $item->produk->kategori);

        foreach ($groupedByKategori as $kategori => $items) {
            $data[$kategori] = $items->groupBy('produk_id')->map(function ($produkItems) {
                $produk = $produkItems->first()->produk;
                return [
                    'nama' => $produk->produk ?? 'Tidak Dikenal',
                    'harga' => $produk->harga ?? 0,
                    'terjual' => $produkItems->sum('qty'),
                    'pendapatan' => $produkItems->sum('subtotal'),
                ];
            });
        }

        // ✅ Produk tanpa kategori → masuk kategori berdasarkan nama produk
        $produkTanpaKategori = $details->filter(function ($item) {
            return $item->produk && !$item->produk->kategori;
        })->groupBy(fn($item) => $item->produk->produk ?? 'Tidak Dikenal');

        foreach ($produkTanpaKategori as $namaProduk => $items) {
            $produk = $items->first()->produk;

            $data[$namaProduk] = collect([
                [
                    'nama' => null,
                    'harga' => $produk->harga ?? 0,
                    'terjual' => $items->sum('qty'),
                    'pendapatan' => $items->sum('subtotal'),
                ]
            ]);
        }

        return view('admin.Layanan.kasir.transaksi.laporan', compact('data'));
    }   
}