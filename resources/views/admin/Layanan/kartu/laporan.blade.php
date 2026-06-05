@extends('layout.sidebarnavbar')
@section('admin-konten')


<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Rekap Kartu - Bulan {{ $namaBulan }} {{ $tahun }}</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="admin/home" class="text-muted text-hover-primary">Beranda</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="admin/layanan-kartu" class="text-muted text-hover-primary">Kartu Anggota</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="admin/layanan-kartu({{ $jk }})" class="text-muted text-hover-primary">{{ $jk }}</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Rekap</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!--begin::Primary button-->
                    <a href="/" target="blank" class="btn btn-sm btn-light-success">Preview Website</a>
                    <!--end::Primary button-->
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
		<div id="kt_app_content" class="app-content flex-column-fluid">
			<!--begin::Content container-->
			<div id="kt_app_content_container" class="app-container container-xxl">
                <div class="row g-5 g-xl-8 mb-2">
                    <div class="col-xl-12">
                        <!--begin: Statistics Widget 6-->
                        <div class="card card-xl-stretch mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body d-flex align-items-center pt-1 pb-0 ">
                                <div class="d-flex flex-column flex-grow-1 py-2 py-lg-13 me-2">
                                    <div class="text-gray-900 fw-bold fs-2 mb-4">Layanan Kartu Perpustakaan {{ $jk }}</div>
                                    <div class="d-flex flex-wrap">
                                        <!--begin::Stat-->
                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6">
                                            <div class="fw-semibold fs-6 text-gray-600">Cetak Baru</div>
                                            <!--begin::Number-->
                                            <div class="d-flex align-items-center">
                                                <i class="ki-outline ki-simcard fs-3 text-success me-2">
                                                </i>
                                                <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="{{ $total[$jk ?? 'Putra']['Anggota Baru'] }}">0</div>
                                            </div>
                                            <!--end::Number-->
                                        </div>
                                        <!--end::Stat-->
                                        <!--begin::Stat-->
                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6">
                                            <div class="fw-semibold fs-6 text-gray-600">Cetak Ulang</div>
                                            <!--begin::Number-->
                                            <div class="d-flex align-items-center">
                                                <i class="ki-outline ki-simcard-2 fs-3 text-danger me-2">
                                                </i>
                                                <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="{{ $total[$jk ?? 'Putra']['Perpanjang/Cetak Ulang'] }}">0</div>
                                            </div>
                                            <!--end::Number-->
                                        </div>
                                        <!--end::Stat-->
                                        <!--begin::Stat-->
                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6">
                                            <div class="fw-semibold fs-6 text-gray-600">Mahasiswa Baru</div>
                                            <!--begin::Number-->
                                            <div class="d-flex align-items-center">
                                                <i class="ki-outline ki-profile-user fs-3 text-primary me-2"></i>
                                                <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="{{ $total[$jk ?? 'Putra']['Mahasiswa Baru'] }}">0</div>
                                            </div>
                                            <!--end::Number-->
                                        </div>
                                        <!--end::Stat-->
                                        <!--begin::Stat-->
                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6">
                                            <div class="fw-semibold fs-6 text-gray-600">Kartu Tercetak</div>
                                            <!--begin::Number-->
                                            <div class="d-flex align-items-center">
                                                <i class="ki-outline ki-check-circle fs-3 text-info me-2"></i>
                                                <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="{{ $total[$jk ?? 'Putra']['Selesai'] }}">0</div><span class="fs-2 fw-bold ms-2">Kartu</span>
                                            </div>
                                            <!--end::Number-->
                                        </div>
                                        <!--end::Stat-->
                                        <!--begin::Stat-->
                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6">
                                            <div class="fw-semibold fs-6 text-gray-600">Pendapatan</div>
                                            <!--begin::Number-->
                                            <div class="d-flex align-items-center">
                                                <i class="ki-outline ki-tag  fs-3 text-warning me-2">
                                                </i>
                                                <span class="fs-2 fw-bold">Rp.</span>
                                                <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="{{ $total[$jk ?? 'Putra']['Anggota Baru'] * 20000 + $total[$jk ?? 'Putra']['Perpanjang/Cetak Ulang'] * 10000 }}">0</div>
                                            </div>
                                            <!--end::Number-->
                                            <!--begin::Label-->
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Stat-->
                                    </div>
                                </div>
                                @if($jk == 'Putra')
                                <img src="admin/assets/media/santri/santripa.png" alt="" class="align-self-end h-150px">
                                @elseif($jk == 'Putri')
                                <img src="admin/assets/media/santri/santripi.png" alt="" class="align-self-end h-150px">
                                @endif
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end: Statistics Widget 6-->
                    </div>
                </div>
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-900">Laporan Harian Layanan Kartu - {{ $jk }}</span>
                                <span class="text-gray-500 mt-1 fw-semibold fs-6">Bulan {{ $namaBulan }} {{ $tahun }}</span>
                            </h3>
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        @if(auth()->user()->hasPermissionTo('layanan kartu-cetak laporan'))
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <a href="{{ route('laporan.kartu.export', ['jk' => request('jk') ?? $jk]) }}?bulan={{ request('bulan') }}&tahun={{ request('tahun') }}" class="btn btn-light-success">
                                <i class="ki-outline ki-exit-up fs-2 me-1"></i>Cetak Laporan
                            </a>
                        </div>
                        @endif
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body py-4">
                        <!--begin::Table-->
                        <table class="table align-middle table-striped fs-6 gy-4" id="kt_ecommerce_products_table">
                            <thead class="fw-bold fs-5 bg-success">
                                <tr class="text-start text-white fw-bold fs-7 text-uppercase gs-0">
                                    <th class="rounded-start ps-5 min-800px">Hari, Tanggal</th>
                                    <th class="text-center">Anggota Baru</th>
                                    <th class="text-center">Perpanjang/Cetak Ulang</th>
                                    <th class="text-center">Mahasiswa Baru</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th class="text-end rounded-end pe-5">Total Pendapatan</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-semibold">
                                @php
                                    // Mengelompokkan data berdasarkan tanggal
                                    $groupedLaporan = $laporan->groupBy('tanggal');
                                @endphp

                                @foreach($groupedLaporan as $tanggal => $items)
                                    @php
                                        $baru = $items->where('kategori', 'Anggota Baru')->sum('total_layanan');
                                        $ulang = $items->where('kategori', 'Perpanjang/Cetak Ulang')->sum('total_layanan');
                                        $maba = $items->where('kategori', 'Mahasiswa Baru')->sum('total_layanan');
                                    @endphp
                                    <tr>
                                        <td class="ps-4"><div class="badge py-4 px-5 fs-6 badge-secondary">{{ Carbon\Carbon::parse($tanggal)->isoFormat('dddd, D MMMM Y') }}</div></td> <!-- Menampilkan hari dalam format lokal -->
                                        <td class="text-center">
                                            <div class="text-gray-900 fs-4">{{ $baru }}</div>
                                            <span class="text-muted fw-semibold text-muted d-block fs-7">Santri</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="text-gray-900 fs-4">{{ $ulang }}</div>
                                            <span class="text-muted fw-semibold text-muted d-block fs-7">Kartu</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="text-gray-900 fs-4">{{ $maba }}</div>
                                            <span class="text-muted fw-semibold text-muted d-block fs-7">Mahasiswa</span>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-end pe-5">
                                            <div class="badge py-4 px-5 fs-6 badge-light-success">Rp. {{ number_format($baru * 20000 + $ulang * 10000, 0, ',', '.') }}</div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
        </div>
    </div>
</div>

<!--begin::Javascript-->
<script>
    var hostUrl = "assets/";
</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="admin/assets/plugins/global/plugins.bundle.js"></script>
<script src="admin/assets/js/scripts.bundle.js"></script>
<!--begin::Veadmin/ndors Javascript(used for this page only)-->
<script src="admin/assets/plugins/custom/datatables/datatables.bundle.js"></script>
<!--end::Vendadmin/ors Javascript-->
<!--begin::Cuadmin/stom Javascript(used for this page only)-->
<script src="admin/assets/js/custom/apps/ecommerce/catalog/products.js"></script>
<script src="admin/assets/js/widgets.bundle.js"></script>
<script src="admin/assets/js/custom/widgets.js"></script>
<script src="admin/assets/js/custom/apps/chat/chat.js"></script>
<script src="admin/assets/js/custom/utilities/modals/upgrade-plan.js"></script>
<script src="admin/assets/js/custom/utilities/modals/create-app.js"></script>
<script src="admin/assets/js/custom/utilities/modals/users-search.js"></script>
<!--end::Custom Javascript-->
<!--end::Custom Javascript-->
@include('layout.footer')

<!--end::Javascript-->

@endsection
