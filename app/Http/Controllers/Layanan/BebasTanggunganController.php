<?php

namespace App\Http\Controllers\Layanan;

use App\Http\Controllers\Controller;
use App\Models\Layanan\Layanan_bebastanggungan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\RedirectResponse;

class BebasTanggunganController extends Controller
{
    //
    public function index()
    {
        $bebaspustaka = Layanan_bebastanggungan::latest()->get();

        return view('admin.Layanan.bebaspustaka.index', compact('bebaspustaka'));

    }

    public function edit($id)
    {
        $bebaspustaka = Layanan_bebastanggungan::findOrFail($id);

        return view('admin.Layanan.bebaspustaka.edit', compact('bebaspustaka'));
    }

    public function store(Request $request)
    {
        $bebaspustaka = Layanan_bebastanggungan::create($request->all());

        // $pesan = $request->pesan;
        // $nomor = $request->nomor;
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
        '_Assalamu’alaikum warahmatullahi wabarakatuh_

        Yth. Bpk. Muhammad Ali Ridla, M.Kom,

        Mahasiswa calon lulusan '. $request->angkatan .' atas nama ' . $request->nama . ' saat ini sedang menunggu verifikasi tanda tangan elektronik untuk _Surat Keterangan Bebas Pustaka_.
        Kami mohon kesediaan Anda untuk melakukan verifikasi melalui tautan berikut:
        📜 www.layanan.lib.ibrahimy.ac.id/layanan-bebaspustaka='.$bebaspustaka->id.'/verifikasi
        Terima kasih atas perhatian dan kerja samanya.

        _Wassalamu’alaikum warahmatullahi wabarakatuh._'
        ),
        CURLOPT_HTTPHEADER => array(
            'Authorization: ' . $token
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return back()->with('success', 'Alhamdulillah, data berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $bebaspustaka = Layanan_bebastanggungan::findOrFail($id);

        $bebaspustaka->update([
            'angkatan' => $request->angkatan,
            'nim' => $request->nim,
            'nama' => $request->nama,
            'pend_pagi' => $request->pend_pagi,
            'prodi' => $request->prodi,
            'kecamatan' => $request->kecamatan,
            'kabupaten' => $request->kabupaten,
            'provinsi' => $request->provinsi,
            'asrama' => $request->asrama,
            'judul' => $request->judul,
            'ket' => $request->ket,
        ]);


        return redirect('/admin/layanan-bebaspustaka')->with('success', 'Alhamdulillah, data berhasil diperbarui');
    }

    public function verifikasi($id)
    {
        $bebaspustaka = Layanan_bebastanggungan::findOrFail($id);

        return view('admin.Layanan.bebaspustaka.verifikasi', compact('bebaspustaka'));
    }
    public function verified(Request $request, $id)
    {
        $bebaspustaka = Layanan_bebastanggungan::findOrFail($id);

        $bebaspustaka->update([
            'verifikasi' => $request->verifikasi,
        ]);

        return back()->with('success', 'Alhamdulillah, dokumen berhasil diverifikasi');
    }

    public function cetak($id)
    {
        $bebaspustaka = Layanan_bebastanggungan::findOrFail($id);

        // return view('admin.Layanan.bebaspustaka.cetak', compact('bebaspustaka'));
        $pdf = Pdf::loadView('admin.Layanan.bebaspustaka.cetak', [
            'bebaspustaka' => $bebaspustaka,
        ]);
        $pdf->setPaper('A4', 'potrait');
        return $pdf->stream('SKBP Perpustakaan Ibrahimy.pdf');
    }

    public function hapus($id): RedirectResponse
    {
        //get post by ID
        $bebespustaka = Layanan_bebastanggungan::findOrFail($id);

        $bebespustaka->delete();


        //redirect to index
        return back()->with('success', 'Alhamdulillah, data berhasil dihapus!');
    }

    public function export($angkatan)
    {
        $bebaspustaka = Layanan_bebastanggungan::where('angkatan', $angkatan)->get();

        // Jika tidak ada data yang ditemukan, berikan respon error
        if ($bebaspustaka->isEmpty()) {
            return back()->with('error', 'Astaghfirullah, Tidak ada data yang ditemukan untuk data angkatan yang dimaksud');
        }

        // Membuat objek Spreadsheet baru
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Menambahkan judul dokumen
        $sheet->mergeCells('A1:L1'); // Menggabungkan sel untuk judul
        $sheet->setCellValue('A1', 'Data Penerima Surat Bebas Pustaka Perpustakaan Ibrahimy ' . ucfirst($angkatan));
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Menambahkan header tabel
        $headers = [
            'ID', 'Angkatan', 'NIM', 'Nama', 'Pend_Diniyah', 'Prodi', 'Kecamatan', 'Kabupaten' , 'Provinsi' , 'Asrama', 'Judul Skripsi', 'Ket'];
        $colIndex = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($colIndex . '3', $header); // Baris header dimulai dari baris 3
            $sheet->getStyle($colIndex . '3')->getFont()->setBold(true);
            $sheet->getStyle($colIndex . '3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle($colIndex . '3')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
            $sheet->getStyle($colIndex . '3')->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()
                ->setARGB('FFD700'); // Warna kuning untuk header
            $colIndex++;
        }

        // Menulis data pengguna ke dalam sheet
        $row = 4; // Mulai dari baris kedua (setelah header)
        foreach ($bebaspustaka as $item) {
            $sheet->setCellValue('A' . $row, $item->id);
            $sheet->setCellValue('B' . $row, $item->angkatan);
            $sheet->setCellValue('C' . $row, $item->nim);
            $sheet->setCellValue('D' . $row, $item->nama);
            $sheet->setCellValue('E' . $row, $item->pend_pagi);
            $sheet->setCellValue('F' . $row, $item->prodi);
            $sheet->setCellValue('G' . $row, $item->kecamatan);
            $sheet->setCellValue('H' . $row, $item->kabupaten);
            $sheet->setCellValue('I' . $row, $item->provinsi);
            $sheet->setCellValue('J' . $row, $item->asrama);
            $sheet->setCellValue('K' . $row, $item->judul);
            $sheet->setCellValue('L' . $row, $item->ket);
            $row++;
        }

        // Menambahkan border pada tabel
        $lastRow = $row - 1;
        $sheet->getStyle('A3:L' . $lastRow)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // Mengatur lebar kolom secara otomatis
        foreach (range('A', 'L') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Menulis file Excel menggunakan Xlsx Writer
        $writer = new Xlsx($spreadsheet);

        // Mengatur response agar file bisa diunduh langsung oleh pengguna
        $fileName = 'Data_SKBP_' . $angkatan . '.xlsx'; // Nama file berdasarkan kategori
        return response()->stream(
            function() use ($writer) {
                $writer->save('php://output'); // Menyimpan file ke output
            },
            Response::HTTP_OK,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
                'Cache-Control' => 'max-age=0',
            ]
        );
    }
}
