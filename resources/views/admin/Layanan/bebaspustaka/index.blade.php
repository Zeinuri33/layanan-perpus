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
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Data Bebas Pustaka</h1>
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
                        <li class="breadcrumb-item text-muted">Bebas Pustaka</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
		<!--begin::Content-->
		<div id="kt_app_content" class="app-content flex-column-fluid">
			<!--begin::Content container-->
			<div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Statistik-->
                <div class="card mb-5 mb-xl-10">
                    <div class="card-body pt-9 pb-0">
                        <!--begin::Details-->
                        <div class="d-flex flex-wrap flex-sm-nowrap">
                            <div class="flex-grow-1">
                                <!--begin::Title-->
                                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                    <!--begin::User-->
                                    <div class="d-flex flex-column">
                                        <!--begin::Name-->
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="text-gray-900 fs-2 fw-bold me-1">Pemberkasan Mahasiswa Semester Akhir</div>  
                                        </div>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Title-->
                                <!--begin::Stats-->
                                <div class="d-flex flex-wrap flex-stack">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column flex-grow-1 pe-8">
                                        <!--begin::Stats-->
                                        <div class="d-flex flex-wrap">
                                            <!--begin::Stat-->
                                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-10">
                                                <!--begin::Number-->
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-outline ki-teacher fs-3 text-primary me-2"></i>
                                                    <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="{{ App\Models\Mahasiswa::count() }}" data-kt-countup-prefix="">0</div><span class="fs-2 ms-1"></span>
                                                </div>
                                                <!--end::Number-->
                                                <!--begin::Label-->
                                                <div class="fw-semibold fs-6 text-gray-500">Mahasiswa</div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Stat-->
                                        </div>
                                        <!--end::Stats-->
                                    </div>
                                    <!--end::Wrapper-->
                                    {{-- <!--begin::Progress-->
                                    <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                                        <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                            <span class="fw-semibold fs-6 text-gray-500">Persentase</span>
                                            <span class="fw-bold fs-6">{{ round($plagiasi->filter(fn($i) => $i->mahasiswa && $i->ket === 'Terverifikasi')->count() / max(1, $plagiasi->filter(fn($i) => $i->mahasiswa)->count()) * 100) }}%</span>
                                        </div>
                                        <div class="h-5px mx-3 w-100 bg-light mb-3">
                                            <div class="bg-success rounded h-5px" role="progressbar" style="width: {{ round($plagiasi->filter(fn($i) => $i->mahasiswa && $i->ket === 'Terverifikasi')->count() / max(1, $plagiasi->filter(fn($i) => $i->mahasiswa)->count()) * 100) }}%;" aria-valuenow="{{ round($plagiasi->filter(fn($i) => $i->mahasiswa && $i->ket === 'Terverifikasi')->count() / max(1, $plagiasi->filter(fn($i) => $i->mahasiswa)->count()) * 100) }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <!--end::Progress--> --}}
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Details-->
                    </div>
                </div>
                <!--end::Statistik-->
				<!--begin::Card-->
				<div class="card">
					<!--begin::Card header-->
                    <div class="card-header border-0 pt-6">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                                <input type="text" data-kt-ecommerce-product-filter="search" class="form-control w-250px ps-12" placeholder="Cari Mahasiswa"/>
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <div class="w-100 mw-150px">
                                <!--begin::Select2-->
                                <select class="form-select" data-control="select2" data-hide-search="true" data-placeholder="Ket" data-kt-ecommerce-product-filter="status">
                                    <option></option>
                                    <option value="all">Semua</option>
                                    <option value="Belum">Belum</option>
                                    <option value="Selesai">Selesai</option>
                                </select>
                                <!--end::Select2-->
                            </div>
                            @if(auth()->user()->hasPermissionTo('layanan bebas pustaka-export'))
                            <a href="#" class="btn btn-light-success" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"><i class="ki-outline ki-exit-up fs-2"></i>Export</a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="{{ route('export.bebaspustaka', ['angkatan' => 2024]) }}" class="menu-link px-3">Angkatan 2024</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="{{ route('export.bebaspustaka', ['angkatan' => 2025]) }}" class="menu-link px-3">Angkatan 2025</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="{{ route('export.bebaspustaka', ['angkatan' => 2026]) }}" class="menu-link px-3">Angkatan 2026</a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            @endif
                            <!--end::Menu-->
                            <!--begin::Add product-->
                            @if(auth()->user()->hasPermissionTo('layanan bebas pustaka-tambah'))
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add">
                                <i class="ki-outline ki-plus fs-2"></i>Tambah
                            </button>
                            @endif
                            <!--end::Add product-->
                        </div>
                        @include('admin.Layanan.bebaspustaka.tambah')
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
					<!--begin::Card body-->
					<div class="card-body py-4">
						<!--begin::Table-->
						<table class="table align-middle table-striped fs-6 gy-5" id="kt_ecommerce_products_table">
							<thead class="fw-bold fs-5 bg-success">
								<tr class="text-start text-white fw-bold fs-7 text-uppercase gs-0">
									<th class="rounded-start ps-5 min-800px">Tanggal</th>
									<th>NIM</th>
									<th>Nama Mahasiswa</th>
									<th>Fakultas</th>
									<th>Prodi</th>
									<th class="text-center">Lulusan</th>
									<th class="text-center">Verifikasi</th>
									<th class="text-end rounded-end pe-5">Opsi</th>
								</tr>
							</thead>
							<tbody class="text-gray-600 fw-semibold">
                                @foreach ($bebaspustaka as $item)
								<tr>
                                    <td class="ps-5"><div class="badge py-3 px-4 fs-7 badge-light">{{ Carbon\Carbon::parse($item->created_at)->isoFormat('dddd, D MMMM Y') }}</div></td>
                                    <td>{{ $item->nim }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>
                                        @if(
                                            $item->prodi == 'S2 – Pendidikan Agama Islam' ||
                                            $item->prodi == 'S2 – Hukum Ekonomi Syariah'
                                        )
                                        <div class="badge py-3 px-4 fs-7 badge-light-secondary">Pasca Sarjana</div>
                                        @elseif(
                                            $item->prodi == 'S1 – Hukum Keluarga Islam' ||
                                            $item->prodi == 'S1 – Hukum Ekonomi Syariah' ||
                                            $item->prodi == 'S1 – Manajemen dan Bisnis Syariah' ||
                                            $item->prodi == 'S1 – Ekonomi Syariah' ||
                                            $item->prodi == 'S1 – Akuntansi Syariah'
                                        )
                                        <div class="badge py-3 px-4 fs-7 badge-light-success">Syariah dan Ekonomi Islam</div>
                                        @elseif(
                                            $item->prodi == 'S1 – Bimbingan dan Penyuluhan Islam' ||
                                            $item->prodi == 'S1 – Komunikasi dan Penyiaran Islam'
                                        )
                                        <div class="badge py-3 px-4 fs-7 badge-light-info">Dakwah</div>
                                        @elseif(
                                            $item->prodi == 'S1 – Pendidikan Agama Islam' ||
                                            $item->prodi == 'S1 – Pendidikan Bahasa Arab' ||
                                            $item->prodi == 'S1 – Pendidikan Islam Anak Usia Dini' ||
                                            $item->prodi == 'S1 – Tadris Matematika'
                                        )
                                        <div class="badge py-3 px-4 fs-7 badge-light-warning">Tarbiyah</div>
                                        @elseif(
                                            $item->prodi == 'S1 – Arsitektur' ||
                                            $item->prodi == 'D3 – Budidaya Perikanan' ||
                                            $item->prodi == 'S1 – Teknologi Hasil Perikanan' ||
                                            $item->prodi == 'S1 – Ilmu Komputer' ||
                                            $item->prodi == 'S1 – Sistem Informasi' ||
                                            $item->prodi == 'S1 – Teknologi Informasi'
                                        )
                                        <div class="badge py-3 px-4 fs-7 badge-light-primary">Sains dan Teknologi</div>
                                        @elseif(
                                            $item->prodi == 'S1 – Akuntansi' ||
                                            $item->prodi == 'S1 – Hukum' ||
                                            $item->prodi == 'S1 – Psikologi' ||
                                            $item->prodi == 'S1 - Pendidikan Bahasa Inggris'
                                        )
                                        <div class="badge py-3 px-4 fs-7 badge-light-danger">Sosial dan Humaniora</div>
                                        @elseif(
                                            $item->prodi == 'S1 – Kebidanan' ||
                                            $item->prodi == 'S1 – Farmasi'
                                        )
                                        <div class="badge py-3 px-4 fs-7 badge-light-secondary">Ilmu Kesehatan</div>
                                        @endif
                                    </td>
                                    <td>{{ $item->prodi }}</td>
									<td class="text-center">{{ $item->angkatan }}</td>
									<td class="text-center">
                                        @if($item->verifikasi == 'Terverifikasi')
                                        <div class="badge py-3 px-4 fs-7 badge-light-success">{{ $item->verifikasi }}</div>
                                        @else
                                        <div class="badge py-3 px-4 fs-7 badge-light-danger">Belum terverifikasi</div>
                                        @endif
                                    </td>
									<td class="text-end pe-5">
										<a href="#" class="ms-1 btn btn-light-success btn-active-success btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Opsi
										<i class="ki-duotone ki-down fs-5 ms-1"></i></a>
										<!--begin::Menu-->
										<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
											<!--begin::Menu item-->
                                            @if(auth()->user()->hasPermissionTo('layanan bebas pustaka-verifikasi'))
											@if($item->ket == "Selesai")
                                            <div class="menu-item px-3">
                                                <a href="{{ asset('/layanan-bebaspustaka='.$item->id.'/verifikasi') }}" class="menu-link px-3" target="_blank" >Verifikasi</a>
											</div>
                                            @endif
                                            @endif
                                            @if(auth()->user()->hasPermissionTo('layanan bebas pustaka-cetak'))
											@if($item->verifikasi == "Terverifikasi")
											@if($item->ket == "Selesai")
											<div class="menu-item px-3">
                                                <a href="{{ asset('bebaspustaka='.$item->id.'') }}" class="menu-link px-3" target="_blank" >Cetak</a>
											</div>
											@else
                                            @endif
                                            @endif
                                            @endif
											<!--end::Menu item-->
											<!--begin::Menu item-->
                                            @if(auth()->user()->hasPermissionTo('layanan bebas pustaka-edit'))
											<div class="menu-item px-3">
                                                <a href="{{ asset('/admin/layanan-bebaspustaka('.$item->id.')=edit') }}" class="menu-link px-3" >Edit</a>
                                            </div>
                                            @endif
											<!--end::Menu item-->
											<!--begin::Menu item-->
                                            @if(auth()->user()->hasPermissionTo('layanan bebas pustaka-hapus'))
											<div class="menu-item px-3">
                                                <a href="{{ asset('/admin/layanan-bebaspustaka('.$item->id.')/hapus') }}" class="menu-link px-3 delete-button">Hapus</a>
											</div>
                                            @endif
											<!--end::Menu item-->
										</div>
										<!--end::Menu-->
                                        {{-- @include('admin.Layanan.bebaspustaka.edit') --}}
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
			<!--end::Content container-->
		</div>
		<!--end::Content-->
    </div>
    <!--end::Content wrapper-->
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
		<script src="admin/assets/js/custom/apps/chat/chat.js"></script>
		<script src="admin/assets/js/custom/utilities/modals/upgrade-plan.js"></script>
		<script src="admin/assets/js/custom/utilities/modals/create-app.js"></script>
		<script src="admin/assets/js/custom/utilities/modals/users-search.js"></script>
		<!--end::Custom Javascript-->
		<!--end::Javascript-->
    <!--begin::Footer-->
    @include('layout.footer')
    <!--end::Footer-->
</div>




@endsection
