<?php

namespace App\Http\Controllers\Layanan;

use App\Http\Controllers\Controller;
use App\Models\Layanan\Layanan_kartu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class KartuController extends Controller
{
    //
    public function index(Request $request)
    {
        $bulan  = $request->input('bulan', now()->month);
        $tahun  = $request->input('tahun', now()->year);
        $jk     = $request->input('jk');
        $search = $request->input('search');
        $ket    = $request->input('ket'); // ✅ TAMBAH

        $baseQuery = Layanan_kartu::whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun);

        // filter jk
        if ($jk) {
            $baseQuery->where('jk', $jk);
        }

        // filter status
        if ($ket === 'Selesai') {
            $baseQuery->where('ket', 'Selesai');
        } elseif ($ket === 'null') {
            $baseQuery->whereNull('ket'); // 🔥 INI PENTING
        }

        // search
        if ($search) {
            $baseQuery->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                ->orWhere('idanggota', 'like', "%{$search}%");
            });
        }

        $kartu = (clone $baseQuery)
            ->latest()
            ->paginate(10)
            ->withQueryString();

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

        return view('admin.Layanan.kartu.kartu', compact(
            'kartu',
            'bulan',
            'tahun',
            'jk',
            'jumlahMahasiswaBaru',
            'jumlahCetakUlang',
            'jumlahAnggotaBaru',
            'jumlahSelesai',
            'pendapatan'
        ));
    }



    public function putraputri(Request $request)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));
        $kartu = Layanan_kartu::latest()->paginate(10)->withQueryString();
        return view('admin.Layanan.kartu.kartu', compact('kartu', 'bulan', 'tahun'));
    }


    public function store(Request $request)
    {
        $bulan = Carbon::now()->isoFormat('MMMM-Y');

        Layanan_kartu::create([
            'jk' => $request->jk,
            'idanggota' => $request->idanggota,
            'nama' => $request->nama,
            'asrama' => $request->asrama,
            'kategori' => $request->kategori,
            'petugas' => $request->petugas,
            'shif' => $request->shif,
            'ket' => $request->ket,
            'slug1' => $request->kategori.'-'.$bulan.'-'.$request->jk,
            'slug2' => $request->kategori.'-'.$bulan.'-'.$request->jk.'-'.$request->ket
        ]);

        return back()->with('success', 'Alhamdulillah, data berhasil ditambahkan');

    }

    public function update(Request $request, $id)
    {
        $kartu = Layanan_kartu::findOrFail($id);

        $kartu->update([
            'jk' => $request->jk,
            'idanggota' => $request->idanggota,
            'nama' => $request->nama,
            'asrama' => $request->asrama,
            'kategori' => $request->kategori,
            'petugas' => $request->petugas,
            'shif' => $request->shif,
            'ket' => $request->ket,
            'slug1' => $request->kategori.'-'.$request->slug1.'-'.$request->jk,
            'slug2' => $request->kategori.'-'.$request->slug1.'-'.$request->jk.'-'.$request->ket
        ]);

        return back()->with('success', 'Alhamdulillah, data berhasil diperbarui');
    }

    public function ubah(Request $request, $id)
    {
        $kartu = Layanan_kartu::findOrFail($id);

        $kartu->update([
            'ket' => $request->ket,
            'slug2' => $request->slug2.'-'.$request->ket
        ]);

        return back()->with('success', 'Alhamdulillah, kartu berhasil dicetak');
    }

    public function simpankartu(Request $request)
    {

        $bulan = Carbon::now()->isoFormat('MMMM-Y');

        Layanan_kartu::create([
            'jk' => $request->jk,
            'idanggota' => $request->idanggota,
            'nama' => $request->nama,
            'asrama' => $request->asrama,
            'kategori' => $request->kategori,
            'petugas' => $request->petugas,
            'shif' => $request->shif,
            'ket' => $request->ket,
            'slug1' => $request->kategori.'-'.$bulan.'-'.$request->jk,
            'slug2' => $request->kategori.'-'.$bulan.'-'.$request->jk.'-'.$request->ket
        ]);

        return view('kartutersimpan');

    }

    public function laporan(Request $request, $jk = null)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));

        // Mengonversi angka bulan menjadi nama bulan
        $namaBulan = Carbon::createFromFormat('m', $bulan)->isoFormat('MMMM');

        // Jika tidak ada jenis kelamin yang dipilih, tampilkan data untuk keduanya
        $laporanQuery = Layanan_kartu::selectRaw('jk, kategori, ket,  DATE(created_at) as tanggal, COUNT(id) as total_layanan')
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->groupBy('jk', 'kategori', 'ket', 'tanggal')
            ->orderBy('tanggal', 'asc')
            ->orderBy('jk', 'asc')  // Mengurutkan berdasarkan jenis kelamin (Putra/Putri)
            ->orderBy('ket', 'asc')  // Mengurutkan berdasarkan jenis keterangan (Selesai/Belum)
            ->orderBy('kategori', 'asc');  // Mengurutkan berdasarkan kategori (Cetak Baru/Cetak Ulang)

        // Jika ada jenis kelamin yang dipilih, filter berdasarkan jenis kelamin tersebut
        if ($jk) {
            $laporanQuery->where('jk', $jk);
        }

        $laporan = $laporanQuery->get();


        // Hitung total cetak baru dan cetak ulang per bulan, per jenis kelamin
        $total = [
            'Putra' => [
                'Anggota Baru' => $laporan->where('jk', 'Putra')->where('kategori', 'Anggota Baru')->sum('total_layanan'),
                'Perpanjang/Cetak Ulang' => $laporan->where('jk', 'Putra')->where('kategori', 'Perpanjang/Cetak Ulang')->sum('total_layanan'),
                'Mahasiswa Baru' => $laporan->where('jk', 'Putra')->where('kategori', 'Mahasiswa Baru')->sum('total_layanan'),

                'Selesai' => $laporan->where('jk', 'Putra')->where('ket', 'Selesai')->sum('total_layanan'),
            ],
            'Putri' => [
                'Anggota Baru' => $laporan->where('jk', 'Putri')->where('kategori', 'Anggota Baru')->sum('total_layanan'),
                'Perpanjang/Cetak Ulang' => $laporan->where('jk', 'Putri')->where('kategori', 'Perpanjang/Cetak Ulang')->sum('total_layanan'),
                'Mahasiswa Baru' => $laporan->where('jk', 'Putri')->where('kategori', 'Mahasiswa Baru')->sum('total_layanan'),

                'Selesai' => $laporan->where('jk', 'Putri')->where('ket', 'Selesai')->sum('total_layanan'),
            ]
        ];

        return view('admin.Layanan.kartu.laporan', compact('laporan', 'bulan', 'namaBulan', 'tahun' , 'total', 'jk'));
    }

    public function exportLaporan(Request $request, $jk = null)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));
        $namaBulan = Carbon::createFromFormat('m', $bulan)->isoFormat('MMMM');

        $laporanQuery = Layanan_kartu::selectRaw('DATE(created_at) as tanggal, kategori, COUNT(*) as total')
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->groupBy('tanggal', 'kategori')
            ->orderBy('tanggal', 'asc');

        // FILTER JK
        if ($jk && $jk !== 'Semua') {
            $laporanQuery->where('jk', $jk);
        }

        $laporan = $laporanQuery->get();

        if ($laporan->isEmpty()) {
            return back()->with('error', 'Data laporan tidak ditemukan.');
        }

        // Rekap data per hari
        $rekap = [];
        foreach ($laporan as $item) {
            $tanggal = $item->tanggal;
            $kategori = $item->kategori;

            if (!isset($rekap[$tanggal])) {
                $rekap[$tanggal] = [
                    'Anggota Baru' => 0,
                    'Perpanjang/Cetak Ulang' => 0,
                    'Mahasiswa Baru' => 0,
                    'total' => 0,
                    'pendapatan' => 0,
                ];
            }

            $rekap[$tanggal][$kategori] = $item->total;
            $rekap[$tanggal]['total'] += $item->total;

            if ($kategori == 'Anggota Baru') {
                $rekap[$tanggal]['pendapatan'] += $item->total * 20000;
            } elseif ($kategori == 'Perpanjang/Cetak Ulang') {
                $rekap[$tanggal]['pendapatan'] += $item->total * 10000;
            }
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Judul
        $judul = 'Rekap Layanan Kartu Perpustakaan - ' . $namaBulan . ' ' . $tahun . ($jk ? ' - '.$jk : '');
        $sheet->mergeCells('A1:G1');
        $sheet->setCellValue('A1', $judul);
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Header
        $headers = ['NO', 'Hari, Tanggal', 'Anggota Baru', 'Perpanjang/Cetak Ulang', 'Mahasiswa Baru', 'Total Layanan', 'Total Pendapatan (Rp)'];
        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col . '3', $header);
            $sheet->getStyle($col . '3')->getFont()->setBold(true);
            $sheet->getStyle($col . '3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle($col . '3')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFD700');
            $col++;
        }

        // Isi data
        $row = 4;
        $no = 1;
        $totalKeseluruhan = [
            'Anggota Baru' => 0,
            'Perpanjang/Cetak Ulang' => 0,
            'Mahasiswa Baru' => 0,
            'total' => 0,
            'pendapatan' => 0,
        ];

        foreach ($rekap as $tanggal => $data) {
            $hariTanggal = Carbon::parse($tanggal)->isoFormat('dddd, D MMMM Y');

            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, $hariTanggal);
            $sheet->setCellValue('C' . $row, $data['Anggota Baru']);
            $sheet->setCellValue('D' . $row, $data['Perpanjang/Cetak Ulang']);
            $sheet->setCellValue('E' . $row, $data['Mahasiswa Baru']);
            $sheet->setCellValue('F' . $row, $data['total']);
            $sheet->setCellValue('G' . $row, $data['pendapatan']);

            $totalKeseluruhan['Anggota Baru'] += $data['Anggota Baru'];
            $totalKeseluruhan['Perpanjang/Cetak Ulang'] += $data['Perpanjang/Cetak Ulang'];
            $totalKeseluruhan['Mahasiswa Baru'] += $data['Mahasiswa Baru'];
            $totalKeseluruhan['total'] += $data['total'];
            $totalKeseluruhan['pendapatan'] += $data['pendapatan'];

            $row++;
        }

        // Total keseluruhan
        $sheet->setCellValue('A' . $row, '');
        $sheet->setCellValue('B' . $row, 'Total Keseluruhan');
        $sheet->setCellValue('C' . $row, $totalKeseluruhan['Anggota Baru']);
        $sheet->setCellValue('D' . $row, $totalKeseluruhan['Perpanjang/Cetak Ulang']);
        $sheet->setCellValue('E' . $row, $totalKeseluruhan['Mahasiswa Baru']);
        $sheet->setCellValue('F' . $row, $totalKeseluruhan['total']);
        $sheet->setCellValue('G' . $row, $totalKeseluruhan['pendapatan']);
        $sheet->getStyle('B' . $row)->getFont()->setBold(true);

        // Border & auto width
        $sheet->getStyle('A3:G' . $row)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Format Rp
        $sheet->getStyle('G4:G' . $row)
            ->getNumberFormat()
            ->setFormatCode('"Rp" #,##0');

        // Output Excel
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Rekap_Layanan_Kartu_' . $namaBulan . '_' . $tahun . ($jk ? "_$jk" : '') . '.xlsx';

        return response()->stream(
            function () use ($writer) {
                $writer->save('php://output');
            },
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Cache-Control' => 'max-age=0',
            ]
        );
    }

    public function exportData(Request $request, $jk)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));

        $data = Layanan_kartu::where('jk', $jk)
            ->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->orderBy('created_at', 'asc')
            ->get();

        if ($data->isEmpty()) {
            return back()->with('error', 'Tidak ada data ditemukan untuk bulan dan tahun tersebut.');
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $namaBulan = Carbon::createFromFormat('m', $bulan)->isoFormat('MMMM');

        // Judul
        $sheet->mergeCells('A1:H1');
        $sheet->setCellValue('A1', 'Data Pelayanan Kartu ' . $jk . ' Bulan ' . $namaBulan . ' ' . $tahun);

        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Header tabel
        $headers = ['No', 'Tanggal', 'ID Anggota', 'Nama', 'Asrama', 'Kategori', 'Petugas', 'Shift', 'Keterangan'];
        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col . '3', $header);
            $sheet->getStyle($col . '3')->getFont()->setBold(true);
            $sheet->getStyle($col . '3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle($col . '3')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFD700');
            $col++;
        }

        // Data isi
        $row = 4;
        $no = 1;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, Carbon::parse($item->created_at)->format('d-m-Y'));
            $sheet->setCellValue('C' . $row, $item->idanggota);
            $sheet->setCellValue('D' . $row, $item->nama);
            $sheet->setCellValue('E' . $row, $item->asrama);
            $sheet->setCellValue('F' . $row, $item->kategori);
            $sheet->setCellValue('G' . $row, $item->petugas);
            $sheet->setCellValue('H' . $row, $item->shif);
            $sheet->setCellValue('I' . $row, $item->ket);
            $row++;
        }

        // Border
        $sheet->getStyle('A3:I' . ($row - 1))->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // Autosize kolom
        foreach (range('A', 'I') as $colID) {
            $sheet->getColumnDimension($colID)->setAutoSize(true);
        }

        // Export
        $fileName = 'Pelayanan_Kartu_' . $jk . '_' . $bulan . '_' . $tahun . '.xlsx';
        $writer = new Xlsx($spreadsheet);

        return response()->stream(
            fn () => $writer->save('php://output'),
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => "attachment; filename=\"$fileName\"",
                'Cache-Control' => 'max-age=0',
            ]
        );
    }


    public function hapus($id): RedirectResponse
    {
        //get post by ID
        $kartu = Layanan_kartu::findOrFail($id);
        $kartu->delete();
        //redirect to index
        return back()->with('success', 'Alhamdulillah, data berhasil dihapus!');
    }


}
