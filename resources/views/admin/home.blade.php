@extends('layout.sidebarnavbar')
{{-- @extends('layouts.app') --}}
@section('admin-konten')

<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Beranda</h1>
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
                        <li class="breadcrumb-item text-muted">Beranda</li>
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
            <div id="kt_app_content_container" class="app-container container-fluid">
                <!--begin::KONTEN-->
                <!--begin::Row-->
				<div class="row gx-5 gx-xl-10 mb-xl-10">
					<!--begin::Col-->
					<div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-10">
						<!--begin::Card widget 4-->
						<div class="card card-flush h-md-50 mb-5 mb-xl-10">
							<!--begin::Header-->
							<div class="card-header pt-5">
								<!--begin::Title-->
								<div class="card-title d-flex flex-column">
									<!--begin::Info-->
									<div class="d-flex align-items-center">
										<!--begin::Currency-->
										<span class="fs-4 fw-semibold text-gray-500 me-1 align-self-start">Rp.</span>
										<!--end::Currency-->
										<!--begin::Amount-->
										<span class="fs-2x fw-bold text-gray-900 me-2 lh-1 ls-n2" data-kt-countup="true" data-kt-countup-value="{{ $pendapatan }}">0</span>
										<!--end::Amount-->
										<span class="badge 
                                            {{ $status == 'naik' ? 'badge-light-success' : 'badge-light-danger' }} fs-base">

                                            <i class="ki-outline 
                                                {{ $status == 'naik' ? 'ki-arrow-up text-success' : 'ki-arrow-down text-danger' }} 
                                                fs-5 ms-n1">
                                            </i>

                                            {{ abs($persen) }}%
                                        </span>
									</div>
									<!--end::Info-->
									<!--begin::Subtitle-->
									<span class="text-gray-500 pt-1 fw-semibold fs-6">Pendapatan Cetak Kartu bulan {{ \Carbon\Carbon::createFromDate($tahun, $bulan)->isoFormat('MMMM Y') }}</span>
									<!--end::Subtitle-->
								</div>
								<!--end::Title-->
							</div>
							<!--end::Header-->
							<!--begin::Card body-->
							<div class="card-body pt-2 pb-4 d-flex align-items-center">
								<!--begin::Labels-->
								<div class="d-flex flex-column content-justify-center w-100">
									<!--begin::Label-->
									<div class="d-flex fs-6 fw-semibold align-items-center">
										<!--begin::Bullet-->
										<div class="bullet w-8px h-6px rounded-2 bg-danger me-3"></div>
										<!--end::Bullet-->
										<!--begin::Label-->
										<div class="text-gray-500 flex-grow-1 me-4">Mahasiswa Baru</div>
										<!--end::Label-->
										<!--begin::Stats-->
										<div class="fw-bolder text-gray-700 text-xxl-end">{{ $jumlahMahasiswaBaru }}</div>
										<!--end::Stats-->
									</div>
									<!--end::Label-->
									<!--begin::Label-->
									<div class="d-flex fs-6 fw-semibold align-items-center my-3">
										<!--begin::Bullet-->
										<div class="bullet w-8px h-6px rounded-2 bg-primary me-3"></div>
										<!--end::Bullet-->
										<!--begin::Label-->
										<div class="text-gray-500 flex-grow-1 me-4">Cetak Ulang</div>
										<!--end::Label-->
										<!--begin::Stats-->
										<div class="fw-bolder text-gray-700 text-xxl-end">{{ $jumlahCetakUlang }}</div>
										<!--end::Stats-->
									</div>
									<!--end::Label-->
									<!--begin::Label-->
									<div class="d-flex fs-6 fw-semibold align-items-center">
										<!--begin::Bullet-->
										<div class="bullet w-8px h-6px rounded-2 me-3" style="background-color: #E4E6EF"></div>
										<!--end::Bullet-->
										<!--begin::Label-->
										<div class="text-gray-500 flex-grow-1 me-4">Anggota Baru</div>
										<!--end::Label-->
										<!--begin::Stats-->
										<div class="fw-bolder text-gray-700 text-xxl-end">{{ $jumlahAnggotaBaru }}</div>
										<!--end::Stats-->
									</div>
									<!--end::Label-->
								</div>
								<!--end::Labels-->
							</div>
							<!--end::Card body-->
						</div>
						<!--end::Card widget 4-->
						<!--begin::Card widget 5-->
						<div class="card card-flush h-md-50 mb-xl-10">
							<!--begin::Header-->
							<div class="card-header pt-5">
								<!--begin::Title-->
								<div class="card-title d-flex flex-column">
									<!--begin::Info-->
									<div class="d-flex align-items-center">
										<!--begin::Amount-->
										<span class="fs-2x fw-bold text-gray-900 me-2 lh-1 ls-n2" data-kt-countup="true"
                                            data-kt-countup-value="{{ $terverifikasi }}">0</span><span class="mx-2">Mhs</span>
										<!--end::Amount-->
										<!--begin::Badge-->
										<span class="badge 
                                            {{ $statusPlagiasi == 'naik' ? 'badge-light-success' : 'badge-light-danger' }} fs-base">

                                            <i class="ki-outline 
                                                {{ $statusPlagiasi == 'naik' ? 'ki-arrow-up text-success' : 'ki-arrow-down text-danger' }} 
                                                fs-5 ms-n1">
                                            </i>

                                            {{ abs($persenPlagiasi) }}%
                                        </span>
										<!--end::Badge-->
									</div>
									<!--end::Info-->
									<!--begin::Subtitle-->
									<span class="text-gray-500 pt-1 fw-semibold fs-6">Jumlah Pemberkasan Tugas Akhir Mahasiswa Calon Lulusan {{ $angkatan + 4}}</span>
									<!--end::Subtitle-->
								</div>
								<!--end::Title-->
							</div>
							<!--end::Header-->
							<!--begin::Card body-->
							<div class="card-body d-flex align-items-end pt-0">
								@php
                                    $total = $totalMahasiswa ?? 0;
                                    
                                    $persen = $total > 0 ? round(($terverifikasi / $total) * 100, 1) : 0;
                                @endphp

                                <!--begin::Progress-->
                                <div class="d-flex align-items-center flex-column mt-3 w-100">
                                    <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                        <span class="fw-bolder fs-6 text-gray-900">
                                            {{ $terverifikasi }} dari {{ $total }} Mahasiswa
                                        </span>
                                        <span class="fw-bold fs-6 text-gray-500">
                                            {{ $persen }}%
                                        </span>
                                    </div>

                                    <div class="h-8px mx-3 w-100 bg-light-success rounded">
                                        <div class="bg-success rounded h-8px"
                                            role="progressbar"
                                            style="width: {{ $persen }}%;"
                                            aria-valuenow="{{ $persen }}"
                                            aria-valuemin="0"
                                            aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                                <!--end::Progress-->
							</div>
							<!--end::Card body-->
						</div>
						<!--end::Card widget 5-->
					</div>
					<!--end::Col-->
					<!--begin::Col-->
					<div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-10">
						<!--begin::Card widget 6-->
						<div class="card card-flush h-md-50 mb-5 mb-xl-10">
							<!--begin::Header-->
							<div class="card-header pt-5">
								<!--begin::Title-->
								<div class="card-title d-flex flex-column">
									<!--begin::Info-->
									<div class="d-flex align-items-center">
										<!--begin::Currency-->
										<span class="fs-4 fw-semibold text-gray-500 me-1 align-self-start">Rp</span>
										<!--end::Currency-->
										<!--begin::Amount-->
										<span class="fs-2x fw-bold text-gray-900 me-2 lh-1 ls-n2" data-kt-countup="true" data-kt-countup-value="{{ $totalPendapatanPlagiasi }}">0</span>
										<!--end::Amount-->
										<span class="badge 
											{{ $statusPendapatanPlagiasi == 'naik' ? 'badge-light-success' : 'badge-light-danger' }} fs-base">

											<i class="ki-outline 
												{{ $statusPendapatanPlagiasi == 'naik' ? 'ki-arrow-up text-success' : 'ki-arrow-down text-danger' }} 
												fs-5 ms-n1">
											</i>

											{{ abs($persenPendapatanPlagiasi) }}%
										</span>
									</div>
									<!--end::Info-->
									<!--begin::Subtitle-->
									<span class="text-gray-500 pt-1 fw-semibold fs-6">Pendapatan Cek Plagiasi TA Mahasiswa Calon Lulusan{{ $angkatan + 4 }}</span>
									<!--end::Subtitle-->
								</div>
								<!--end::Title-->
							</div>
							<!--end::Header-->
							<!--begin::Card body-->
							<div class="card-body d-flex align-items-end px-0 pb-0">
								<!--begin::Chart-->
								<div id="kt_card_widget_6_chart" class="w-100" style="height: 80px"></div>
								<!--end::Chart-->
							</div>
							<!--end::Card body-->
						</div>
						<!--end::Card widget 6-->
						<!--begin::Card widget 7-->
						<div class="card card-flush h-md-50 mb-xl-10">
							<!--begin::Header-->
							<div class="card-header pt-5">
								<!--begin::Title-->
								<div class="card-title d-flex flex-column">
									<!--begin::Amount-->
									<span class="fs-2hx fw-bold text-gray-900 me-2 lh-1 ls-n2">{{ $jumlahDosen }}</span>
									<!--end::Amount-->
									<!--begin::Subtitle-->
									<span class="text-gray-500 pt-1 fw-semibold fs-6">Dosen Terdaftar</span>
									<!--end::Subtitle-->
								</div>
								<!--end::Title-->
							</div>
							<!--end::Header-->
							<!--begin::Card body-->
							<div class="card-body d-flex flex-column justify-content-end pe-0">
								<!--begin::Title-->
								<span class="fs-6 fw-bolder text-gray-800 d-block mb-2">Daftar Dosen</span>
								<!--end::Title-->
								<!--begin::Users group-->
								<div class="symbol-group symbol-hover flex-nowrap">
									@php
										$colors = ['primary', 'success', 'info', 'danger', 'warning'];
										$prevColor = null;
									@endphp

									@foreach ($dosen as $d)
										@php
											$nama = $d->nama ?? '';

											// inisial 2 huruf
											$inisial = collect(explode(' ', $nama))
												->filter()
												->map(fn($w) => strtoupper(substr($w, 0, 1)))
												->take(2)
												->implode('');

											// pilih warna random tapi tidak boleh sama dengan sebelumnya
											do {
												$color = $colors[array_rand($colors)];
											} while ($color === $prevColor);

											$prevColor = $color;
										@endphp

										<div class="symbol symbol-35px symbol-circle"
											data-bs-toggle="tooltip"
											title="{{ $nama }}">

											<span class="symbol-label bg-{{ $color }} text-inverse-{{ $color }} fw-bold">
												{{ $inisial }}
											</span>
										</div>
									@endforeach
									<a href="admin/dosen" class="symbol symbol-35px symbol-circle">
										<span class="symbol-label bg-light text-gray-400 fs-8 fw-bold">+{{ $jumlahDosen - 5 }}</span>
									</a>
								</div>
								<!--end::Users group-->
							</div>
							<!--end::Card body-->
						</div>
						<!--end::Card widget 7-->
					</div>
					<!--end::Col-->
					<!--begin::Col-->
					<div class="col-lg-12 col-xl-12 col-xxl-6 mb-5 mb-xl-0">
						<!--begin::Chart widget 3-->
						<div class="card card-flush overflow-hidden h-md-100">
							<!--begin::Header-->
							<div class="card-header py-5">
								<!--begin::Title-->
								<h3 class="card-title align-items-start flex-column">
									<span class="card-label fw-bold text-gray-900">Layanan Kasir</span>
									<span class="text-gray-500 mt-1 fw-semibold fs-6">Bulan {{ \Carbon\Carbon::createFromDate($tahun, $bulan)->isoFormat('MMMM Y') }}</span>
								</h3>
								<!--end::Title-->
								
							</div>
							<!--end::Header-->
							<!--begin::Card body-->
							<div class="card-body d-flex justify-content-between flex-column pb-1 px-0">
								<div class="d-flex flex-wrap gap-10">

						{{-- ================= HARI INI ================= --}}
						<div class="flex-fill">
							<h6 class="ms-9 mb-4 text-gray-700 fw-bold">Hari Ini</h6>

							@foreach ($pendapatanKasirHarian as $kasir => $total)
								<div class="px-9 mb-5">
									<div class="d-flex mb-2">
										<span class="fs-4 fw-semibold text-gray-500 me-1">Rp.</span>
										<span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2" data-kt-countup="true" data-kt-countup-value="{{ $total }}">0</span>
									</div>

									<span class="fs-6 fw-semibold text-gray-500">
										Kasir {{ $kasir }}
									</span>
								</div>
							@endforeach
						</div>

						{{-- ================= BULAN INI ================= --}}
						<div class="flex-fill">
							<h6 class="ms-9 mb-4 text-gray-700 fw-bold">Bulan Ini</h6>
							

							@foreach ($pendapatanKasirBulanan as $kasir => $total)
								<div class="px-9 mb-5">
									<div class="d-flex mb-2">
										<span class="fs-4 fw-semibold text-gray-500 me-1">Rp.</span>
										<span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2" data-kt-countup="true" data-kt-countup-value="{{ $total }}">0</span>
									</div>

									<span class="fs-6 fw-semibold text-gray-500">
										Kasir {{ $kasir }}
									</span>
								</div>
							@endforeach
						</div>

						</div>
								<!--begin::Chart-->
								<div id="kt_charts_widget_3" class="min-h-auto ps-4 pe-6" style="height: 300px"></div>
								<!--end::Chart-->
							</div>
							<!--end::Card body-->
						</div>
						<!--end::Chart widget 3-->
					</div>
					<!--end::Col-->
				</div>
				<!--end::Row-->
                <!--end::KONTEN-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->

    @include('layout.footer')
    <!--end::Footer-->
</div>

@endsection

<!--begin::Javascript-->
<script>var hostUrl = "assets/";</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="assets/plugins/global/plugins.bundle.js"></script>
<script src="assets/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used for this page only)-->
<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
<script src="assets/plugins/custom/vis-timeline/vis-timeline.bundle.js"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="assets/js/widgets.bundle.js"></script>
<script src="assets/js/custom/widgets.js"></script>
<script src="assets/js/custom/apps/chat/chat.js"></script>
<script src="assets/js/custom/utilities/modals/upgrade-plan.js"></script>
<script src="assets/js/custom/utilities/modals/users-search.js"></script>
<!--end::Custom Javascript-->
<!--end::Javascript-->