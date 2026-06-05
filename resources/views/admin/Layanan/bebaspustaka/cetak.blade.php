<html>
<head>
    <title>{{ $bebaspustaka->prodi }}_{{ $bebaspustaka->nim }}_{{ $bebaspustaka->nama }}</title>
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
        <p>SURAT KETERANGAN <br>BEBAS TANGGUNGAN PERPUSTAKAAN</p>
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
            <tr>
                <td class="label">NPM</td>
                <td class="colon">:</td>
                <td>{{ $bebaspustaka->nim }}</td>
            </tr>
            <tr>
                <td class="label">Nama</td>
                <td class="colon">:</td>
                <td>{{ $bebaspustaka->nama }}</td>
            </tr>
            <tr>
                <td class="label">Pend. Diniyah</td>
                <td class="colon">:</td>
                <td>{{ $bebaspustaka->pend_pagi }}</td>
            </tr>
            <tr>
                <td class="label">Fakultas</td>
                <td class="colon">:</td>
                <td>
                    @if(
                        $bebaspustaka->prodi == 'S2 – Pendidikan Agama Islam' ||
                        $bebaspustaka->prodi == 'S2 – Hukum Ekonomi Syariah'
                    )
                    Pasca Sarjana
                    @elseif(
                        $bebaspustaka->prodi == 'S1 – Hukum Keluarga Islam' ||
                        $bebaspustaka->prodi == 'S1 – Hukum Ekonomi Syariah' ||
                        $bebaspustaka->prodi == 'S1 – Manajemen dan Bisnis Syariah' ||
                        $bebaspustaka->prodi == 'S1 – Ekonomi Syariah' ||
                        $bebaspustaka->prodi == 'S1 – Akuntansi Syariah'
                    )
                    Syariah dan Ekonomi Islam
                    @elseif(
                        $bebaspustaka->prodi == 'S1 – Bimbingan dan Penyuluhan Islam' ||
                        $bebaspustaka->prodi == 'S1 – Komunikasi dan Penyiaran Islam'
                    )
                    Dakwah
                    @elseif(
                        $bebaspustaka->prodi == 'S1 – Pendidikan Agama Islam' ||
                        $bebaspustaka->prodi == 'S1 – Pendidikan Bahasa Arab' ||
                        $bebaspustaka->prodi == 'S1 – Pendidikan Islam Anak Usia Dini' ||
                        $bebaspustaka->prodi == 'S1 – Tadris Matematika'
                    )
                    Tarbiyah
                    @elseif(
                        $bebaspustaka->prodi == 'S1 – Arsitektur' ||
                        $bebaspustaka->prodi == 'D3 – Budidaya Perikanan' ||
                        $bebaspustaka->prodi == 'S1 – Teknologi Hasil Perikanan' ||
                        $bebaspustaka->prodi == 'S1 – Ilmu Komputer' ||
                        $bebaspustaka->prodi == 'S1 – Sistem Informasi' ||
                        $bebaspustaka->prodi == 'S1 – Teknologi Informasi'
                    )
                    Sains dan Teknologi
                    @elseif(
                        $bebaspustaka->prodi == 'S1 – Akuntansi' ||
                        $bebaspustaka->prodi == 'S1 – Hukum' ||
                        $bebaspustaka->prodi == 'S1 – Psikologi' ||
                        $bebaspustaka->prodi == 'S1 - Pendidikan Bahasa Inggris'
                    )
                    Sosial dan Humaniora
                    @elseif(
                        $bebaspustaka->prodi == 'S1 – Kebidanan' ||
                        $bebaspustaka->prodi == 'S1 – Farmasi'
                    )
                    Ilmu Kesehatan
                    @endif
                </td>
            </tr>
            <tr>
                <td class="label">Prodi</td>
                <td class="colon">:</td>
                <td>{{ $bebaspustaka->prodi }}</td>
            </tr>
            <tr>
                <td class="label">Kecamatan</td>
                <td class="colon">:</td>
                <td>{{ $bebaspustaka->kecamatan }}</td>
            </tr>
            <tr>
                <td class="label">Kabupaten</td>
                <td class="colon">:</td>
                <td>{{ $bebaspustaka->kabupaten }}</td>
            </tr>
            <tr>
                <td class="label">Provinsi</td>
                <td class="colon">:</td>
                <td>{{ $bebaspustaka->provinsi }}</td>
            </tr>
            <tr>
                <td class="label">Asrama</td>
                <td class="colon">:</td>
                <td>{{ $bebaspustaka->asrama }}</td>
            </tr>
            <tr>
                <td class="label">Judul Skripsi</td>
                <td class="colon">:</td>
                <td class="skripsi">{{ $bebaspustaka->judul }}</td>
            </tr>
        </table>
    </div>
    <div class="centang">
        <table>
            <tr>
                <td>Adalah benar-benar telah bebas dari tanggungan :</td>
            </tr>
        </table>
        <div class="container">
            <table>
                <tr>
                    <td class="checkbox">
                        <input type="checkbox">
                    </td>
                    <td>
                        Tidak memiliki tanggungan pinjaman koleksi Perpustakaan.
                    </td>
                </tr>
                <tr>
                    <td class="checkbox">
                        <input type="checkbox">
                    </td>
                    <td>
                        Telah melakukan cek plagiasi tugas akhir dengan hasil sesuai ketentuan.
                    </td>
                </tr>
                <tr>
                    <td class="checkbox">
                        <input type="checkbox">
                    </td>
                    <td>
                        Menyerahkan <em>softcopy/file</em> Skripsi yang telah disetujui oleh Pembimbing dan Penguji dan Ketua Sidang.
                    </td>
                </tr>
                <tr>
                    <td class="checkbox">
                        <input type="checkbox">
                    </td>
                    <td>
                        Menyerahkan <em>hardcopy</em> Skripsi asli sebanyak 3 (tiga) eksemplar.
                    </td>
                </tr>
                <tr>
                    <td class="checkbox">
                        <input type="checkbox">
                    </td>
                    <td>
                        Mengisi surat pernyataan bermatrai tentang kesiapan publikasi karya ilmiah secara <em>full text</em>.
                    </td>
                </tr>
            </table>
        </div>
        <table>
            <tr>
                <td>Demikian surat keterangan bebas tanggungan Perpustakaan dibuat untuk dipergunakan sebagaimana mestinya.</td>
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
                            @if($bebaspustaka->verifikasi == "Terverifikasi")
                            <td>{!! DNS2D::getBarcodeHTML("www.lib.ibrahimy.ac.id/bebaspustaka=$bebaspustaka->id", 'QRCODE', 2, 2) !!}</td>                            <td style="text-align: left; vertical-align: middle;">
                                <img src="ibrahimy/ttdelektronik.png" alt="TTD" style="width: 60%; height: auto; margin-left: 10px;">
                            </td>
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
        <img src="ibrahimy/ttdelektronik1.png" alt="Footer Surat" style="width: 50%; height: auto;">
        <img src="ibrahimy/footer.png" alt="Footer Surat">
    </div>
</body>
</html>
