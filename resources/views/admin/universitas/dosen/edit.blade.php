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
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">{{ $dosen->nama }}</h1>
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
                        <li class="breadcrumb-item text-muted">
                            <a href="admin/dosen" class="text-muted text-hover-primary">Dosen</a>
                        </li>
                        <!--end::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">{{ $dosen->nama }}</li>
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
                <div class="card mb-5 mb-xl-10" data-select2-id="select2-data-134-nbkd">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Edit Data</h3>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--begin::Card header-->
                    <!--begin::Content-->
                    <div id="kt_account_settings_profile_details" class="collapse show" data-select2-id="select2-data-kt_account_settings_profile_details">
                        <!--begin::Form-->
                        <form id="kt_account_profile_details_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate" method="POST" enctype="multipart/form-data" action="{{ route('dosen.update', $dosen->id) }}" data-select2-id="select2-data-kt_account_profile_details_form">
                            @csrf
                            @method('PUT')
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                <!--begin::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Nomor Induk Dosen Nasional(NIDN)</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="nidn" value="{{ $dosen->nidn }}" class="form-control mb-3 mb-lg-0" placeholder="NIDN">
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6 required">Nama Dosen</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="nama" value="{{ $dosen->nama }}" class="form-control mb-3 mb-lg-0" placeholder="Nama Dosen" required>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Program Studi</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <select name="prodi" class="form-select mb-2" data-control="select2" data-hide-search="false" data-placeholder="Pilih Program Studi">
                                            <option value="{{ $dosen->prodi }}">{{ $dosen->prodi }}</option>
                                            <optgroup label="Fakultas Syariah dan Ekonomi Islam">
                                                <option value="Hukum Keluarga Islam">Hukum Keluarga Islam</option>
                                                <option value="Hukum Ekonomi Syariah">Hukum Ekonomi Syariah</option>
                                                <option value="Manajemen Bisnis Syariah">Manajemen Bisnis Syariah</option>
                                                <option value="Ekonomi Syariah">Ekonomi Syariah</option>
                                                <option value="Akuntansi Syariah">Akuntansi Syariah</option>
                                            </optgroup>
                                            <optgroup label="Fakultas Dakwah">
                                                <option value="Bimbingan Penyuluhan Islam">Bimbingan dan Penyuluhan Islam</option>
                                                <option value="Komunikasi Penyiaran Islam">Komunikasi dan Penyiaran Islam</option>
                                            </optgroup>
                                            <optgroup label="Fakultas Tarbiyah">
                                                <option value="Pendidikan Agama Islam">Pendidikan Agama Islam</option>
                                                <option value="Pendidikan Bahasa Arab">Pendidikan Bahasa Arab</option>
                                                <option value="Pendidikan Islam Anak Usia Dini">Pendidikan Islam Anak Usia Dini</option>
                                                <option value="Tadris Matematika">Tadris Matematika</option>
                                            </optgroup>
                                            <optgroup label="Fakultas Sains dan Teknologi">
                                                <option value="Arsitektur">Arsitektur</option>
                                                <option value="Budidaya Perikanan">Budidaya Perikanan</option>
                                                <option value="Teknologi Hasil Perikanan">Teknologi Hasil Perikanan</option>
                                                <option value="Ilmu Komputer">Ilmu Komputer</option>
                                                <option value="Sistem Informasi">Sistem Informasi</option>
                                                <option value="Teknologi Informasi">Teknologi Informasi</option>
                                            </optgroup>
                                            <optgroup label="Fakultas Ilmu Sosial dan Humaniora">
                                                <option value="Akuntansi">Akuntansi</option>
                                                <option value="Hukum">Hukum</option>
                                                <option value="Psikologi">Psikologi</option>
                                                <option value="Pendidikan Bahasa Inggris">Pendidikan Bahasa Inggris</option>
                                            </optgroup>
                                            <optgroup label="Fakultas Ilmu Kesehatan">
                                                <option value="Kebidanan">Kebidanan</option>
                                                <option value="Farmasi">Farmasi</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-14">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">No. HP/Kontak</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="nomor" value="{{ $dosen->nomor }}" class="form-control mb-3 mb-lg-0" placeholder="Kontak/No.HP Dosen">
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Card body-->
                            <!--begin::Actions-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <a href="/admin/dosen" class="btn btn-light btn-active-light-primary me-2">Cancel</a>
                                <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Simpan Perubahan</button>
                            </div>
                            <!--end::Actions-->
                        <input type="hidden"></form>
                        <!--end::Form-->
                    </div>
                    <!--end::Content-->
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
    <!--begin::Footer-->
    @include('layout.footer')
    <!--end::Footer-->
</div>




@endsection
