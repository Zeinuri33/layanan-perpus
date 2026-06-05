<html>
<head>
    <title>Lembar Kesediaan Publikasi_{{ $plagiasi->mahasiswa->prodi }}_{{ $plagiasi->mahasiswa->nim }}_{{ $plagiasi->mahasiswa->nama }}</title>
    <style>
        @page {
            margin: 0px;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.6;
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
            margin-top: 100px;
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
            width: 150px;
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
    
    <div class="judul">
        <p>LEMBAR PERNYATAAN <br>KESEDIAAN PUBLIKASI KARYA ILMIAH</p>
    </div>
    <div class="centang">
        <table>
            <tr>
                <td>Saya yang bertanda tangan di bawah ini</td>
            </tr>
        </table>
    </div>
    <div class="isi">
        <table>
            <tr>
                <td class="label">Nama</td>
                <td class="colon">:</td>
                <td>{{ $plagiasi->mahasiswa->nama }}</td>
            </tr>
            <tr>
                <td class="label">NIM</td>
                <td class="colon">:</td>
                <td>{{ $plagiasi->mahasiswa->nim }}</td>
            </tr>
            <tr>
                <td class="label">Program Studi</td>
                <td class="colon">:</td>
                <td>{{ $plagiasi->mahasiswa->prodi }}</td>
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
                <td class="label">Jenis Karya Ilmiah</td>
                <td class="colon">:</td>
                <td>Skripsi</td>
            </tr>
        </table>
    </div>
    <div class="centang">
        <table>
            <tr>
                <td style="text-align: justify; text-indent: 30px;">
                    Demi pengembangan ilmu pengetahuan, menyetujui untuk memberikan Hak Bebas Royalti Non-Eksklusif (Non Exclusive Royalty-Free Right) Kepada Perpustakaan Universitas Ibrahimy atas karya ilmiah saya berupa hasil penelitian yang berjudul:
                </td>
            </tr>

            <tr>
                <td style="text-align: center; font-weight: bold;">
                    {{ $plagiasi->judul }}
                </td>
            </tr>

            <tr>
                <td style="text-align: justify; text-indent: 30px;"">
                    Dengan Hak Bebas Royalti Non-eksklusif ini Pusat Perpustakaan Universitas Ibrahimy berhak menyimpan, alih media/format, mengelola dalam bentuk pangkalan data (database), merawat, dan mempublikasikan tugas akhir saya selama tetap mencantumkan nama saya sebagai penulis/pencipta dan sebagai pemilik Hak Cipta.
                </td>
            </tr>
            <tr>
                <td style="text-align: justify; text-indent: 30px;"">
                    Demikian pernyataan ini saya buat untuk dapat dipergunakan sebagaimana mestinya.
                </td>
            </tr>
        </table>
    </div>
    <div class="isi">
        
    </div>
    
    <p></p>
    <div class="ttd">
        <table>
            <tr>
                <td class="jarak"></td>
                <td>Situbondo, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</td>
            </tr>

            <tr>
                <td class="jarak"></td>
                <td>Yang Menyatakan,</td>
            </tr>

            <tr>
                <td class="jarak"></td>
                <td style="padding: 10px 0;">

                    <!-- KOTAK MATERAI -->
                    <div style="
                        width: 80px;
                        height: 30px;
                        border: 1px dashed #000;
                        text-align: center;
                        font-size: 14px;
                        margin-left: 10px;
                        padding-top: 5px; /* 🔥 ini kuncinya */
                        padding-bottom: 20px; /* 🔥 ini kuncinya */
                    ">
                        Materai<br>10.000
                    </div>
                </td>
            </tr>
            <tr>
                <td class="jarak"></td>
                <td class="kepala">
                    {{ $plagiasi->mahasiswa->nama }}
                </td>
            </tr>
        </table>
    </div>
    <p></p>
    <p></p>
    <div class="ket">
    </div>
    
</body>
</html>
