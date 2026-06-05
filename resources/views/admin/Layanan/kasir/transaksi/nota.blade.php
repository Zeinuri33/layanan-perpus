<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Nota Transaksi</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            line-height: 1.4;
            width: 300px;
            margin: auto;
            color: #000;
        }
        .center { text-align: center; }
        .bold { font-weight: bold; }
        .line { border-top: 1px dashed #000; margin: 6px 0; }
        table { width: 100%; border-collapse: collapse; }
        td { vertical-align: top; }
        .total-label { width: 60%; }
        .qr { margin-top: 10px; text-align: center; }

        @media print {
            @page { size: auto; margin: 0mm; }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="center bold">
        PERPUSTAKAAN IBRAHIMY<br>
        Jl. KHR. Syamsul Arifin, Sukorejo, Sumberejo, Kec. Banyuputih, Kabupaten Situbondo, Jawa Timur 68374<br>
        Telp: 0851-1735-1997<br>
    </div>

    <div class="line"></div>
    <div class="line"></div>

    <div>
        Tanggal: {{ now()->format('d/m/Y H:i') }}<br>
        ID Transaksi: {{ str_pad($transaksi->id, 4, '0', STR_PAD_LEFT) }}<br>
        Kasir: Petugas {{ $transaksi->kasir }}
    </div>

    <div class="line"></div>

    @php
        $totalAsli = 0;
    @endphp

    <table>
        @foreach ($transaksi->details as $item)
        <tr>
            <td colspan="2">{{ $item->produk->produk }}</td>
        </tr>
        <tr>
            <td>{{ $item->qty }} x {{ number_format($item->produk->harga, 0, ',', '.') }}</td>
            <td style="text-align:right;">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
        </tr>
        @php
            $totalAsli += $item->subtotal;
        @endphp
        @endforeach
    </table>

    <div class="line"></div>

    <table>
        <tr>
            <td class="total-label">Total</td>
            <td style="text-align:right;">Rp{{ number_format($totalAsli, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Potongan</td>
            <td style="text-align:right;">-Rp{{ number_format($transaksi->potongan, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Donasi</td>
            <td style="text-align:right;">Rp{{ number_format($transaksi->donasi, 0, ',', '.') }}</td>
        </tr>
        <tr class="bold">
            <td>Total Bayar</td>
            <td style="text-align:right;">Rp{{ number_format($transaksi->total_harga + $transaksi->donasi, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Tunai</td>
            <td style="text-align:right;">Rp{{ number_format($transaksi->uang_dibayar, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Kembalian</td>
            <td style="text-align:right;">Rp{{ number_format($transaksi->uang_kembalian, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="line"></div>
    <div class="line"></div>

    <div class="center">
        <small>Terima kasih</small><br>
        <small>Anda Berbelanja Sambil Beramal.</small>
        <small>www.lib.ibrahimy.ac.id</small>
    </div>

    {{-- Jika ingin menambahkan QR --}}
    {{-- <div class="qr">
        <img src="{{ asset('path/to/qrcode.png') }}" width="100">
    </div> --}}
</body>
</html>
