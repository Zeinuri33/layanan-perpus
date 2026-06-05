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
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Rata-rata Plagiasi</h1>
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
                            <a href="admin/layanan-cekplagiasi" class="text-muted text-hover-primary">Cek Plagiasi</a>
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
                <!--begin::Card-->
				<div class="card">
					<!--begin::Card header-->
                    <div class="card-header border-0 pt-6">
                        <!--begin::Card title-->
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-900">
                                Klasemen Tingkat Plagiasi Per-Program Studi
                            </span>

                            <span class="text-gray-500 mt-1 fw-semibold fs-6">
                                Mahasiswa Calon Lulusan 
                                @if($angkatan != 'all')
                                    {{ $angkatan + 4 }}
                                @else
                                    Semua Calon Lulusan
                                @endif
                                Universitas Ibrahimy
                            </span>
                        </h3>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <!--begin::Add product-->
                            <div class="badge py-4 px-5 fs-5 badge-light-danger">Tingkat Plagiasi {{ $totalRataPlagiasi }}%</div>
                            <!--end::Add product-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
					<!--begin::Card body-->
					<div class="card-body py-4">
						<!--begin::Table-->
						<table class="table align-middle table-striped fs-6 gy-3" id="kt_ecommerce_products_table">
							<thead class="fw-bold fs-5 bg-danger">
								<tr class="text-start text-white fw-bold fs-7 text-uppercase gs-0">
									<th class="rounded-start text-center ps-3 min-800px">NO</th>
									<th></th>
									<th>Program Studi</th>
									<th>Fakultas</th>
									<th></th>
									<th class="text-center">Jumlah Cek Plagiasi	</th>
									<th class="text-center">Jumlah Lulus</th>
									<th class="text-end rounded-end pe-5">Tingkat Plagiasi</th>
								</tr>
							</thead>
							<tbody class="fw-semibold">
                                @foreach ($rataPlagiasi as $index => $prodi)
								<tr>
                                    <td class="ps-5 text-center">
                                        <div class="badge py-3 px-4 fs-7 badge-light-danger">{{ $index + 1 }}</div>
                                    </td>
                                    <td></td>
                                    <td>{{ $prodi->prodi }}</td>
                                    <td>
                                        @if($prodi->fakultas == "Syariah dan Ekonomi Islam")
                                        <div class="badge py-3 px-4 fs-7 badge-light-success">Fakultas {{ $prodi->fakultas }}</div>
                                        @elseif($prodi->fakultas == "Dakwah")
                                        <div class="badge py-3 px-4 fs-7 badge-light-info">Fakultas {{ $prodi->fakultas }}</div>
                                        @elseif($prodi->fakultas == "Tarbiyah")
                                        <div class="badge py-3 px-4 fs-7 badge-light-warning">Fakultas {{ $prodi->fakultas }}</div>
                                        @elseif($prodi->fakultas == "Sains dan Teknologi")
                                        <div class="badge py-3 px-4 fs-7 badge-light-primary">Fakultas {{ $prodi->fakultas }}</div>
                                        @elseif($prodi->fakultas == "Sosial dan Humaniora")
                                        <div class="badge py-3 px-4 fs-7 badge-light-danger">Fakultas {{ $prodi->fakultas }}</div>
                                        @elseif($prodi->fakultas == "Ilmu Kesehatan")
                                        <div class="badge py-3 px-4 fs-7 badge-light-secondary">Fakultas {{ $prodi->fakultas }}</div>
                                        @endif
                                    </td>
                                    <td></td>
                                    <td class="text-center">
                                        <div class="text-gray-900 mb-1 fs-6">{{ $prodi->jumlah_mahasiswa_cek ?? 0 }}</div>
                                        <span class="text-muted fw-semibold text-muted d-block fs-7">Mahasiswa</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="text-gray-900 mb-1 fs-6">{{ $prodi->jumlah_plagiasi_ok ?? 0 }}</div>
                                        <span class="text-muted fw-semibold text-muted d-block fs-7">Mahasiswa</span>
                                    </td>
                                    <td class="text-end pe-5">
                                        <div class="badge py-3 px-4 fs-7 badge-light-danger">{{ number_format($prodi->rata_plagiasi, 2) }}%</div>
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
<script src="admin/assets/js/widgets.bundle.js"></script>
<script src="admin/assets/js/custom/widgets.js"></script>
<!--end::Custom Javascript-->
<!--end::Javascript-->
<!--begin::Footer-->
@include('layout.footer')
<!--end::Footer-->

@endsection
