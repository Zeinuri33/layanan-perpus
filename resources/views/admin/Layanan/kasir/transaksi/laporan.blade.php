@extends('layout.sidebarnavbar')
@section('admin-konten')


<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Laporan Penjualan</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="/" class="text-muted text-hover-primary">Beranda</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Laporan</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
			<div id="kt_app_content_container" class="app-container container-xxl">
                <div class="card card-flush">
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5 rounded-bottom" style="background-image: url('{{ asset('admin/assets/media/santri/bg-biru.png') }}'); background-size: cover; background-position: center; background-color: rgba(0,0,0,0.3); background-blend-mode: darken; color: white;">                        
                        <!--begin::Card title-->
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-white">Laporan Penjualan</span>
                            <span class="text-gray-300 mt-1 fw-semibold fs-6">
                                @if (request('tanggal'))
                                    Tanggal: {{ \Carbon\Carbon::parse(request('tanggal'))->translatedFormat('d F Y') }}
                                @else
                                    Bulan: {{ \Carbon\Carbon::create()->month((int) request('bulan', now()->month))->translatedFormat('F') }} {{ request('tahun', now()->year) }}
                                @endif
                            </span>
                        </h3>
                        <!--end::Card title-->

						<div class="card-toolbar d-flex justify-content-end">
                            <form method="GET" action="{{ route('laporan') }}" class="d-flex gap-2 justify-content-end">
                                <div class="col-md-3">
                                    <select name="kasir" class="form-control form-control-sm" data-control="select2" data-hide-search="true">
                                        <option value="">Semua Kasir</option>
                                        <option value="Putra" {{ request('kasir') == 'Putra' ? 'selected' : '' }}>Putra</option>
                                        <option value="Putri" {{ request('kasir') == 'Putri' ? 'selected' : '' }}>Putri</option>
                                        <option value="FIK" {{ request('kasir') == 'FIK' ? 'selected' : '' }}>FIK</option>
                                    </select>
                                </div>
                                <input type="date" name="tanggal" id="filterTanggal" value="{{ request('tanggal') }}" class="form-control form-control-sm" placeholder="Tanggal">

                                <select name="bulan" id="filterBulan" class="form-select form-select-sm" data-control="select2" data-hide-search="true">
                                    <option value="">Pilih Bulan</option>
                                    @for ($m = 1; $m <= 12; $m++)
                                        <option value="{{ $m }}" {{ request('bulan') == $m ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                                        </option>
                                    @endfor
                                </select>

                                <select name="tahun" id="filterTahun" class="form-select form-select-sm" data-control="select2" data-hide-search="true">
                                    <option value="">Pilih Tahun</option>
                                    @for ($y = 2023; $y <= now()->year; $y++)
                                        <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>{{ $y }}</option>
                                    @endfor
                                </select>

                                <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                            </form>
                        </div>  
                    </div>
                    <div class="card-body pt-4">
                        <div class="table-responsive">
                            @php
                                $totalKeseluruhan = 0;
                            @endphp
                            <table class="table align-middle table-striped fs-6 gy-4" id="kt_ecommerce_products_table">
                                <thead class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <tr class="fw-bold text-white bg-primary">
                                        <th class="rounded-start ps-4">Produk</th>
                                        <th>Rincian</th>
                                        <th>Harga</th>
                                        <th>Terjual</th>
                                        <th></th>
                                        <th>Total</th>
                                        <th></th>
                                        <th class="text-end rounded-end pe-4">Pendapatan</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold">
                                    @foreach($data as $kategori => $items)
                                        @php
                                            $totalKategori = 0;
                                        @endphp
                                        <tr>
                                            <td class="ps-4">{{ $kategori }}</td>
                                            <td>
                                                @foreach ($items as $item)
                                                @if($item['nama'] == null)    
                                                @else
                                                <div class="badge py-2 px-3 fs-7 badge-light-primary mb-1 w-75 border-bottom">
                                                    {{ $item['nama'] }}
                                                </div>
                                                @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($items as $item)
                                                <div class="badge py-2 px-3 fs-7 badge-light-warning mb-1 w-75 border-bottom">
                                                    Rp.{{ number_format($item['harga'], 0, ',', '.') }}<br>
                                                </div>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($items as $item)
                                                    <div class="badge py-2 px-3 fs-7 badge-light-primary mb-1 border-bottom">
                                                    {{ $item['terjual'] }} x
                                                    </div><br>
                                                @endforeach
                                            </td>
                                            <td></td>
                                            <td>
                                                @foreach ($items as $item)
                                                    <div class="badge py-2 px-3 fs-7 badge-light-primary mb-1 border-bottom">
                                                    Rp.{{ number_format($item['pendapatan'], 0, ',', '.') }}<br>
                                                    @php $totalKategori += $item['pendapatan']; @endphp
                                                    </div><br>
                                                @endforeach
                                            </td>
                                            <td></td>
                                            <td class="text-end pe-4">
                                                <div class="badge py-3 px-4 fs-6 badge-light-success mb-1 border-bottom">
                                                Rp.{{ number_format($totalKategori, 0, ',', '.') }}
                                                </div>
                                            </td>
                                        </tr>
                                        @php
                                            $totalKeseluruhan += $totalKategori;
                                        @endphp
                                    @endforeach
                                    <tr class="fw-bold bg-warning">
                                        <td class="rounded-start"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td> TotalPendapatan</td>
                                        <td></td>
                                        <td class="text-end rounded-end pe-6">
                                            Rp.{{ number_format($totalKeseluruhan, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tanggal = document.getElementById('filterTanggal');
        const bulan = $('#filterBulan');
        const tahun = $('#filterTahun');

        // Jika pilih tanggal, kosongkan bulan dan tahun
        tanggal.addEventListener('change', function () {
            if (this.value) {       
                bulan.val('').trigger('change');
                tahun.val('').trigger('change');
            }
        });

        // Jika pilih bulan atau tahun, kosongkan tanggal
        bulan.on('change.select2', function () {
            if (this.value) {
                tanggal.value = '';
            }
        });

        tahun.on('change.select2', function () {
            if (bulan.val()) {
                tanggal.value = '';
            }
        });
    });
</script>


<!--begin::Javascript-->
    <script>var hostUrl = "assets/";</script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="admin/assets/plugins/global/plugins.bundle.js"></script>
    <script src="admin/assets/js/scripts.bundle.js"></script>
    <!--end::Globadmin/al Javascript Bundle-->
    <!--begin::Veadmin/ndors Javascript(used for this page only)-->
    <script src="admin/assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <!--end::Vendadmin/ors Javascript-->
    <!--begin::Cuadmin/stom Javascript(used for this page only)-->
    <script src="admin/assets/js/custom/apps/ecommerce/catalog/products.js"></script>

@include('layout.footer')

@endsection