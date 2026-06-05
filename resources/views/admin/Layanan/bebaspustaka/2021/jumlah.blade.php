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
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Rekap Pemberkasan</h1>
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
                            <a href="admin/layanan-ketbebaspustaka" class="text-muted text-hover-primary">Bebas Pustaka</a>
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
                                Pemberkasan 
                                @if($angkatan != 'all')
                                    {{ $angkatan + 4 }}
                                @else
                                    Semua Angkatan
                                @endif
                            </span>

                            <span class="text-gray-500 mt-1 fw-semibold fs-6">
                                Mahasiswa Semester Akhir 
                                @if($angkatan != 'all')
                                    Angkatan {{ $angkatan + 4 }}
                                @else
                                    Semua Angkatan
                                @endif
                                Universitas Ibrahimy
                            </span>
                        </h3>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
					<!--begin::Card body-->
					<div class="card-body py-4">
						<!--begin::Table-->
						<table class="table align-middle table-row-dashed fs-6 gy-3">
							<thead class="fw-bold fs-5 bg-primary">
								<tr class="text-start text-white fw-bold fs-7 text-uppercase gs-0">
									<th class="rounded-start text-center min-800px">NO</th>
									<th></th>
									<th>Program Studi</th>
									<th>Fakultas</th>
									<th></th>
									<th></th>
									<th></th>
									<th class="text-end rounded-end pe-5">Jumlah Pemberkasan</th>
								</tr>
							</thead>
							<tbody class="fw-semibold">
                                @php $no = 1; @endphp
                                @foreach ($rekap as $fakultas => $prodis)
                                    @php 
                                        $subtotal = collect($prodis)->sum(); 
                                    @endphp

                                    @foreach ($prodis as $prodi => $jumlah)
                                    <tr>
                                        <td class="text-center ps-2">
                                            <div class="badge py-3 px-4 fs-7 badge-light-primary">{{ $no++ }}</div>
                                        </td>
                                        <td></td>
                                        <td>{{ $prodi }}</td>
                                        <td>
                                            @if($fakultas == "Syariah dan Ekonomi Islam")
                                            <div class="badge py-3 px-4 fs-7 badge-light-success">Fakultas {{ $fakultas }}</div>
                                            @elseif($fakultas == "Dakwah")
                                            <div class="badge py-3 px-4 fs-7 badge-light-info">Fakultas {{ $fakultas }}</div>
                                            @elseif($fakultas == "Tarbiyah")
                                            <div class="badge py-3 px-4 fs-7 badge-light-warning">Fakultas {{ $fakultas }}</div>
                                            @elseif($fakultas == "Sains dan Teknologi")
                                            <div class="badge py-3 px-4 fs-7 badge-light-primary">Fakultas {{ $fakultas }}</div>
                                            @elseif($fakultas == "Sosial dan Humaniora")
                                            <div class="badge py-3 px-4 fs-7 badge-light-danger">Fakultas {{ $fakultas }}</div>
                                            @elseif($fakultas == "Ilmu Kesehatan")
                                            <div class="badge py-3 px-4 fs-7 badge-light-secondary">Fakultas {{ $fakultas }}</div>
                                            @endif
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-end pe-5">
                                            <div class="text-gray-900 mb-1 fs-6">{{ $jumlah }}</div>
                                            <span class="text-muted fw-semibold text-muted d-block fs-7">Mahasiswa</span>
                                        </td>
                                    </tr>
                                    @endforeach

                                    {{-- SUBTOTAL PER FAKULTAS --}}
                                    <tr class="fw-bold bg-light-primary">
                                        <td colspan="7" class="text-end pe-5">Subtotal Pemberkasan Mahasiswa Fakultas {{ $fakultas }}</td>
                                        <td class="text-end pe-5">
                                            <div class="text-gray-900 fs-6">{{ $subtotal }}</div>
                                            <span class="text-muted fw-semibold d-block fs-7">Mahasiswa</span>
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
<!--begin::Footer-->
@include('layout.footer')
<!--end::Footer-->

@endsection
