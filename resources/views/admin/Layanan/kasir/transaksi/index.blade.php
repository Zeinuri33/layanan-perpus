@extends('layout.sidebarnavbar')
@section('admin-konten')

<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Data Transaksi</h1>
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
                        <li class="breadcrumb-item text-muted">Transaksi</li>
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
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-2">
                                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                                <input type="text" data-kt-ecommerce-product-filter="search" class="form-control form-control-sm w-250px ps-12" placeholder="Cari Transaksi"/>
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--end::Card title-->

						<div class="card-toolbar">
							<!--begin::Add customer-->
                            <form id="filterForm" method="GET" action="{{ route('kasir-transaksi.index') }}" class="row gx-3 my-2">
                                <div class="col-md-3 my-1">
                                    <select name="kasir" class="form-select form-select-sm" data-control="select2" data-hide-search="true">
                                        <option value="">Semua Kasir</option>
                                        <option value="Putra" {{ request('kasir') == 'Putra' ? 'selected' : '' }}>Putra</option>
                                        <option value="Putri" {{ request('kasir') == 'Putri' ? 'selected' : '' }}>Putri</option>
                                        <option value="FIK" {{ request('kasir') == 'FIK' ? 'selected' : '' }}>FIK</option>
                                        <option value="FSEI" {{ request('kasir') == 'FSEI' ? 'selected' : '' }}>FSEI</option>
                                    </select>
                                </div>
                                <div class="col-md-2 my-1">
                                    <input type="date" name="tanggal" id="filterTanggal" placeholder="tanggal" value="{{ request('tanggal') }}" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-3 my-1">
                                    <select name="bulan" id="filterBulan" class="form-control form-control-sm" data-control="select2" data-hide-search="true">
                                        <option value="">Pilih Bulan</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                                                {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                                            </option>
                                        @endfor
                                    </select>           
                                </div>
                                <div class="col-md-2 my-1">
                                    <select name="tahun" id="filterTahun" class="form-control form-control-sm" data-control="select2" data-hide-search="true">
                                        <option value="">Pilih Tahun</option>
                                        @for ($y = now()->year; $y >= 2020; $y--)
                                            <option value="{{ $y }}" {{ request('tahun') == $y ? 'selected' : '' }}>{{ $y }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-2 my-1">
                                    <button class="btn btn-success btn-sm" type="submit">Filter</button>
                                </div>
                            </form>
                            @if(auth()->user()->hasPermissionTo('kasir transaksi-tambah'))
							<!--begin::Add product-->
							<button class="btn btn-primary btn-sm my-2" data-bs-toggle="modal" data-bs-target="#kt_modal_tambah">Transaksi Baru</button>
							<!--end::Add product-->
                            @include('admin.Layanan.kasir.transaksi.tambah')
                            <!--end::Add customer-->
                            @endif
						</div>
                    </div>

                    <div class="card-body pt-4">
                        <div class="table-responsive">
                            <table class="table align-middle table-striped fs-6 gy-3" id="kt_ecommerce_products_table">
                                <thead class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <tr class="fw-bold text-white bg-primary">
                                        <th class="rounded-start ps-4">Tanggal</th>
                                        <th>No.Transaksi</th>
                                        <th>Total</th>
                                        <th>Donasi</th>
                                        <th>Diskon</th>
                                        <th>Dibayar</th>
                                        <th>Kembalian</th>
                                        <th class="text-end rounded-end pe-4">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    @foreach ($transaksi as $item)
                                        <tr>
                                            <td class="ps-4">
										        <div class="badge py-3 px-4 fs-7 badge-light-primary">{{ Carbon\Carbon::parse($item->created_at)->isoFormat('dddd, D MMMM Y') }}</div>
                                            </td>
                                            <td>{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}
                                                <span class="badge 
                                                    {{ $item->kasir == 'Putra' ? 'badge-light-primary' : 
                                                    ($item->kasir == 'Putri' ? 'badge-light-danger' : 'badge-light-danger') }}">
                                                    {{ $item->kasir == 'Putra' ? 'Pa' : ($item->kasir == 'Putri' ? 'Pi' : 'FIK') }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="badge py-3 px-4 fs-7 badge-light-warning">
                                                    Rp. {{ number_format($item->total_harga, 0, ',', '.') }}
                                                </div>
                                            </td>
                                            <td>Rp. {{ number_format($item->donasi, 0, ',', '.') }}</td>
                                            <td>Rp. {{ number_format($item->potongan, 0, ',', '.') }}</td>
                                            <td>
                                                <div class="badge py-3 px-4 fs-7 badge-light-success">
                                                    Rp. {{ number_format($item->uang_dibayar, 0, ',', '.') }}
                                                </div>
                                            </td>
                                            <td>Rp. {{ number_format($item->uang_kembalian, 0, ',', '.') }}</td>
                                            <td class="text-end pe-4">
                                                <button href="#" class="btn btn-icon btn-light-info btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_detail{{ $item->id }}"><i class="ki-outline ki-burger-menu fs-4"></i></button>
                                                @if(auth()->user()->hasPermissionTo('kasir transaksi-cetak'))
                                                <a href="{{ asset('transaksi/cetak/'.$item->id) }}" target="_blank" class="btn btn-icon btn-light-primary btn-sm"><i class="ki-outline ki-printer fs-4"></i></a>
                                                @endif
                                                @if(auth()->user()->hasPermissionTo('kasir transaksi-hapus'))
                                                <a href="{{ asset('transaksi/hapus/'.$item->id) }}" class="btn btn-icon btn-light-danger btn-sm delete-button"><i class="ki-outline ki-trash fs-4"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                        @include('admin.Layanan.kasir.transaksi.detail')
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tambahkan script ini -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tanggalInput = document.getElementById('filterTanggal');
            const bulanInput = $('#filterBulan');
            const tahunInput = $('#filterTahun');

            // Saat tanggal diubah → reset bulan & tahun
            tanggalInput.addEventListener('change', function () {
                if (this.value) {
                    bulanInput.val('').trigger('change'); // Reset bulan
                    tahunInput.val('').trigger('change'); // Reset tahun
                }
            });

            // Saat bulan diubah → reset tanggal
            bulanInput.on('change.select2', function () {
                if (this.value) {
                    tanggalInput.value = '';
                }
            });

            // Saat tahun diubah → reset tanggal (hanya jika bulan ada)
            tahunInput.on('change.select2', function () {
                if (bulanInput.val()) {
                    tanggalInput.value = '';
                }
            });
        });
    </script>

    {{-- DataTables JS --}}
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
