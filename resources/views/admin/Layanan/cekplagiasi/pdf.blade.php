<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $plagiasi->mahasiswa->prodi ?? $plagiasi->nama }}_{{ $plagiasi->mahasiswa->nim ?? $plagiasi->ket }}_{{ $plagiasi->mahasiswa->nama ??'' }}</title>
    <style>
        @page {
            margin: 0px;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            /* line-height: 1.6; */
        }
        .isi {
            max-width: 480px;
            margin: 0 auto;
        }
        .centang {
            max-width: 550px;
            margin: 0 auto;
            text-align: justify;
        }
        .kop {
            max-width: 794px;
            margin: 10 auto;
            text-align: center;
        }

        .ttd {
            max-width: 794px;
            text-align: center;
        }


        .footer {
            margin-left: 25px;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            text-align: left;
        }

        .footer img {
            width: 100%;
            height: auto;
        }

        .judul {
            font-weight: bold;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto;
        }
        td {
            /* padding: 2px 0; */
            vertical-align: top;
        }
        .label {
            width: 120px;
        }
        .jarak {
            width: 450px;
        }
        .kepala {
            font-weight: bold;
        }
        .colon {
            width: 10px;
        }
        .container {
            margin: 0 auto;
        }
        .checkbox {
            width: 20px;
        }
        em {
            font-style: italic;
        }
        .signature img {
            height: auto;
        }
        img {
            max-width: 749px;
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="kop">
        <img src="ibrahimy/header.png" alt="Kop Surat">
    </div>
    <div class="judul">
        <p>SURAT KETERANGAN <br>HASIL PEMERIKSAAN PLAGIASI</p>
    </div>
    <div class="centang">
        <table>
            <tr>
                <td>Yang bertanda tangan di bawah ini</td>
            </tr>
        </table>
    </div>
    <div class="isi">
        <table>
            <tr>
                <td class="label">Nama</td>
                <td class="colon">:</td>
                <td>Muhammad Ali Ridla, M.Kom.</td>
            </tr>
            <tr>
                <td class="label">Jabatan</td>
                <td class="colon">:</td>
                <td>Kepala Perpustakaan</td>
            </tr>
        </table>
    </div>
    <div class="centang">
        <table>
            <tr>
                <td>Menyatakan dengan sebenarnya bahwa:</td>
            </tr>
        </table>
    </div>
    <div class="isi">
        <table>
            @if($plagiasi->mahasiswa_id == null)
            <tr>
                <td class="label">Nama</td>
                <td class="colon">:</td>
                <td>{{ $plagiasi->nama }}</td>
            </tr>
            <tr>
                <td class="label">Keterangan</td>
                <td class="colon">:</td>
                <td>{{ $plagiasi->ket }}</td>
            </tr>
            <tr>
                <td class="label">Judul Karya</td>
                <td class="colon">:</td>
                <td class="skripsi">{{ $plagiasi->judul }}</td>
            </tr>
            @else
            <tr>
                <td class="label">NIM</td>
                <td class="colon">:</td>
                <td>{{ $plagiasi->mahasiswa->nim }}</td>
            </tr>
            <tr>
                <td class="label">Nama</td>
                <td class="colon">:</td>
                <td>{{ $plagiasi->mahasiswa->nama }}</td>
            </tr>
            <tr>
                <td class="label">Fakultas</td>
                <td class="colon">:</td>
                <td>
                    @if(
                        $plagiasi->mahasiswa->prodi == 'Hukum Keluarga Islam' ||
                        $plagiasi->mahasiswa->prodi == 'Hukum Ekonomi Syariah' ||
                        $plagiasi->mahasiswa->prodi == 'Manajemen Bisnis Syariah' ||
                        $plagiasi->mahasiswa->prodi == 'Ekonomi Syariah' ||
                        $plagiasi->mahasiswa->prodi == 'Akuntansi Syariah'
                    )
                    Syariah dan Ekonomi Islam
                    @elseif(
                        $plagiasi->mahasiswa->prodi == 'Bimbingan Penyuluhan Islam' ||
                        $plagiasi->mahasiswa->prodi == 'Komunikasi Penyiaran Islam'
                    )
                    Dakwah
                    @elseif(
                        $plagiasi->mahasiswa->prodi == 'Pendidikan Agama Islam' ||
                        $plagiasi->mahasiswa->prodi == 'Pendidikan Bahasa Arab' ||
                        $plagiasi->mahasiswa->prodi == 'Pendidikan Islam Anak Usia Dini' ||
                        $plagiasi->mahasiswa->prodi == 'Tadris Matematika'
                    )
                    Tarbiyah
                    @elseif(
                        $plagiasi->mahasiswa->prodi == 'Arsitektur' ||
                        $plagiasi->mahasiswa->prodi == 'Budidaya Perikanan' ||
                        $plagiasi->mahasiswa->prodi == 'Teknologi Hasil Perikanan' ||
                        $plagiasi->mahasiswa->prodi == 'Ilmu Komputer' ||
                        $plagiasi->mahasiswa->prodi == 'Sistem Informasi' ||
                        $plagiasi->mahasiswa->prodi == 'Teknologi Informasi'
                    )
                    Sains dan Teknologi
                    @elseif(
                        $plagiasi->mahasiswa->prodi == 'Akuntansi' ||
                        $plagiasi->mahasiswa->prodi == 'Hukum' ||
                        $plagiasi->mahasiswa->prodi == 'Psikologi' ||
                        $plagiasi->mahasiswa->prodi == 'Pendidikan Bahasa Inggris'
                    )
                    Sosial dan Humaniora
                    @elseif(
                        $plagiasi->mahasiswa->prodi == 'Kebidanan' ||
                        $plagiasi->mahasiswa->prodi == 'Farmasi'
                    )
                    Ilmu Kesehatan
                    @endif
                </td>
            </tr>
            <tr>
                <td class="label">Prodi</td>
                <td class="colon">:</td>
                <td>{{ $plagiasi->mahasiswa->prodi ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Kecamatan</td>
                <td class="colon">:</td>
                <td>{{ $plagiasi->mahasiswa->kecamatan }}</td>
            </tr>
            <tr>
                <td class="label">Kabupaten</td>
                <td class="colon">:</td>
                <td>{{ $plagiasi->mahasiswa->kabupaten }}</td>
            </tr>
            <tr>
                <td class="label">Provinsi</td>
                <td class="colon">:</td>
                <td>{{ $plagiasi->mahasiswa->provinsi }}</td>
            </tr>
            <tr>
                <td class="label">Judul Skripsi</td>
                <td class="colon">:</td>
                <td class="skripsi">{{ $plagiasi->judul }}</td>
            </tr>
            @endif
        </table>
    </div>
    <div class="centang">
        @isset($plagiasi->mahasiswa_id)
            <table>
                <tr>
                    <td>Dengan dosen Pembimbing :</td>
                </tr>
            </table>
            <div class="isi">
                <table>
                    <tr>
                        <td>1. {{ $plagiasi->dosen?->nama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>2. {{ $plagiasi->dosen2?->nama ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        @endisset

        <table>
            <tr>
                <td>Telah dilakukan cek plagiasi di Perpustakaan Universitas Ibrahimy dengan persentase plagiasi terakhir sebesar
                    <span style="font-weight: bold;">{{ optional($plagiasi->riwayatPlagiasi->last())->persentase }}%</span>
                    .
                </td>
            </tr>
        </table>
        <p></p>
        <table>
            <tr>
                <td>Demikian Surat Keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.</td>
            </tr>
        </table>
    </div>
    <p></p>
    <div class="ttd">
        <table>
            <tr>
                <td class="jarak"></td>
                <td>Sukorejo, {{ Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</td>
            </tr>
            <tr>
                <td class="jarak"></td>
                <td>Kepala Perpustakaan,</td>
            </tr>
            <tr>
                <td class="jarak"></td>
                <td>
                    <table style="width: 100%; text-align: left;">
                        <tr>
                            @if(optional($plagiasi->riwayatPlagiasi->last())->persentase <= 30)
                                @if(optional($plagiasi->riwayatPlagiasi->last())->persentase == null)
                                @else
                                <td>{!! DNS2D::getBarcodeHTML("www.layanan.lib.ibrahimy.ac.id/hasilcekplagiasi=$plagiasi->id", 'QRCODE', 3, 3) !!}</td>
                                <td style="text-align: left; vertical-align: middle;">
                                    <img src="ibrahimy/ttdelektronik.png" alt="TTD" style="width: 60%; height: auto; margin-left: 10px;">
                                </td>
                                @endif
                                @else
                                <p></p>
                                <p></p>
                                <p></p>
                                <p></p>
                            @endif
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="jarak"></td>
                <td class="kepala">Muhammad Ali Ridla, M.Kom.</td>
            </tr>
        </table>
    </div>
    <p></p>
    <p></p>
    <div class="ket">
    </div>
    <div class="footer">
        <img src="ibrahimy/ttdelektronik1.png" alt="Footer Surat" style="margin-left: 20px; width: 40%; height: auto;">
        <img src="ibrahimy/footer.png" alt="Footer Surat">
    </div>
</body>
</html>
