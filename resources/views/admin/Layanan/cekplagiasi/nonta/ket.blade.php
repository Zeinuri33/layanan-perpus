<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $data->nama }}</title>
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
            <tr>
                <td class="label">Nama</td>
                <td class="colon">:</td>
                <td>{{ $data->nama }}</td>
            </tr>
            <tr>
                <td class="label">Keterangan</td>
                <td class="colon">:</td>
                <td>{{ $data->ket }}</td>
            </tr>
            <tr>
                <td class="label">Judul Karya</td>
                <td class="colon">:</td>
                <td class="skripsi">{{ $data->judul }}</td>
            </tr>
        </table>
    </div>
    <div class="centang">
        <table>
            <tr>
                <td>Telah dilakukan cek plagiasi di Perpustakaan Universitas Ibrahimy dengan persentase plagiasi terakhir sebesar
                    <span style="font-weight: bold;">{{ $data->persentase }}%</span>
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
                                <td>{!! DNS2D::getBarcodeHTML("www.layanan.lib.ibrahimy.ac.id/hasilplagiasi=$data->id", 'QRCODE', 3, 3) !!}</td>
                                <td style="text-align: left; vertical-align: middle;">
                                    <img src="ibrahimy/ttdelektronik.png" alt="TTD" style="width: 60%; height: auto; margin-left: 10px;">
                                </td>
                                <p></p>
                                <p></p>
                                <p></p>
                                <p></p>
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
