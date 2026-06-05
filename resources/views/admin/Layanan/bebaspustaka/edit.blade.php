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
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">{{ $bebaspustaka->nama }}</h1>
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
                            <a href="admin/layanan-bebaspustaka" class="text-muted text-hover-primary">Bebas Pustaka</a>
                        </li>
                        <!--end::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">{{ $bebaspustaka->nama }}</li>
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
                        <form id="kt_account_profile_details_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate" method="POST" enctype="multipart/form-data" action="{{ route('layanan-bebaspustaka.update', $bebaspustaka->id) }}" data-select2-id="select2-data-kt_account_profile_details_form">
                            @csrf
                            @method('PUT')
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                <!--begin::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Tahun Lulusan</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <select class="form-select" name="angkatan" data-control="select2" data-hide-search="true" data-placeholder="Pilih Lulusan">
                                            <option value="{{ $bebaspustaka->angkatan }}">{{ $bebaspustaka->angkatan }}</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                            <option value="2028">2028</option>
                                            <option value="2029">2029</option>
                                            <option value="2030">2030</option>
                                            <option value="2031">2031</option>
                                            <option value="2032">2032</option>
                                            <option value="2033">2033</option>
                                            <option value="2034">2034</option>
                                            <option value="2035">2035</option>
                                            <option value="2036">2036</option>
                                        </select>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Nomor Induk Mahasiswa</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="nim" value="{{ $bebaspustaka->nim }}" class="form-control mb-3 mb-lg-0" placeholder="Nomor Induk Mahasiswa" required autocomplete="nim">
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Nama Mahasiswa</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="nama" value="{{ $bebaspustaka->nama }}" class="form-control mb-3 mb-lg-0" placeholder="Nama Mahasiswa" required autocomplete="nama">
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Pendidikan Diniyah</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <select class="form-select" name="pend_pagi" data-control="select2" data-hide-search="true" data-placeholder="Pilih Pendidikan Diniyah Terakhir" required autocomplete="pend_pagi">
                                            <option value="{{ $bebaspustaka->pend_pagi }}">{{ $bebaspustaka->pend_pagi }}</option>
                                            <option value="Madrasah Ibtidaiyah">Madrasah Ibtidaiyah</option>
                                            <option value="Madrasah Tsanawiyah">Madrasah Tsanawiyah</option>
                                            <option value="Madrasah Aliyah">Madrasah Aliyah</option>
                                            <option value="Madrasah I'dadiyah">Madrasah I'dadiyah</option>
                                            <option value="Madrasah Ta'hiliyah">Madrasah Ta'hiliyah</option>
                                            <option value="Madrasatul Qur'an">Madrasatul Qur'an</option>
                                            <option value="Ma'had Aly">Ma'had Aly</option>
                                            <option value="Lulus">Lulus</option>
                                            <option value="Luaran">Luaran</option>
                                        </select>
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
                                            <option value="{{ $bebaspustaka->prodi }}">{{ $bebaspustaka->prodi }}</option>
                                            <optgroup label="Pasca Sarjana">
                                                <option value="S2 – Pendidikan Agama Islam">S2 – Pendidikan Agama Islam</option>
                                                <option value="S2 – Hukum Ekonomi Syariah">S2 – Hukum Ekonomi Syariah</option>
                                            </optgroup>
                                            <optgroup label="Fakultas Syariah dan Ekonomi Islam">
                                                <option value="S1 – Hukum Keluarga Islam">S1 – Hukum Keluarga Islam</option>
                                                <option value="S1 – Hukum Ekonomi Syariah">S1 – Hukum Ekonomi Syariah</option>
                                                <option value="S1 – Manajemen dan Bisnis Syariah">S1 – Manajemen dan Bisnis Syariah</option>
                                                <option value="S1 – Ekonomi Syariah">S1 – Ekonomi Syariah</option>
                                                <option value="S1 – Akuntansi Syariah">S1 – Akuntansi Syariah</option>
                                            </optgroup>
                                            <optgroup label="Fakultas Dakwah">
                                                <option value="S1 – Bimbingan dan Penyuluhan Islam">S1 – Bimbingan dan Penyuluhan Islam</option>
                                                <option value="S1 – Komunikasi dan Penyiaran Islam">S1 – Komunikasi dan Penyiaran Islam</option>
                                            </optgroup>
                                            <optgroup label="Fakultas Tarbiyah">
                                                <option value="S1 – Pendidikan Agama Islam">S1 – Pendidikan Agama Islam</option>
                                                <option value="S1 – Pendidikan Bahasa Arab">S1 – Pendidikan Bahasa Arab</option>
                                                <option value="S1 – Pendidikan Islam Anak Usia Dini">S1 – Pendidikan Islam Anak Usia Dini</option>
                                                <option value="S1 – Tadris Matematika">S1 – Tadris Matematika</option>
                                            </optgroup>
                                            <optgroup label="Fakultas Sains dan Teknologi">
                                                <option value="S1 – Arsitektur">S1 – Arsitektur</option>
                                                <option value="D3 – Budidaya Perikanan">D3 – Budidaya Perikanan</option>
                                                <option value="S1 – Teknologi Hasil Perikanan">S1 – Teknologi Hasil Perikanan</option>
                                                <option value="S1 – Ilmu Komputer">S1 – Ilmu Komputer</option>
                                                <option value="S1 – Sistem Informasi">S1 – Sistem Informasi</option>
                                                <option value="S1 – Teknologi Informasi">S1 – Teknologi Informasi</option>
                                            </optgroup>
                                            <optgroup label="Fakultas Ilmu Sosial dan Humaniora">
                                                <option value="S1 – Akuntansi">S1 – Akuntansi</option>
                                                <option value="S1 – Hukum">S1 - Hukum</option>
                                                <option value="S1 – Psikologi">S1 - Psikologi</option>
                                                <option value="S1 - Pendidikan Bahasa Inggris">S1 - Pendidikan Bahasa Inggris</option>
                                            </optgroup>
                                            <optgroup label="Fakultas Ilmu Kesehatan">
                                                <option value="S1 – Kebidanan">S1 – Kebidanan</option>
                                                <option value="S1 – Farmasi">S1 – Farmasi</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Kecamatan(Alamat)</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="kecamatan" value="{{ $bebaspustaka->kecamatan }}" class="form-control mb-3 mb-lg-0" placeholder="Nama Kecamatan Asal" required autocomplete="kecamatan">
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Kabupaten/Kota</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="kabupaten" value="{{ $bebaspustaka->kabupaten }}" class="form-control mb-3 mb-lg-0" placeholder="Nama Kabupaten/Kota Asal" required autocomplete="kabupaten">
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Provinsi</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="provinsi" value="{{ $bebaspustaka->provinsi }}" class="form-control mb-3 mb-lg-0" placeholder="Nama Provinsi/Asal" required autocomplete="provinsi">
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Asrama</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="asrama" value="{{ $bebaspustaka->asrama }}" class="form-control mb-3 mb-lg-0" placeholder="Asrama" required autocomplete="asrama">
                                        <!--end::Image input-->
                                        <div class="form-text">Contoh Penulisan : A.01 (tanpa spasi) - Ketik 'Luaran' jika tidak pernah mondok</div>                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Judul Tugas Akhir (Skripsi/Tesis)</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row">
                                        <textarea name="judul" class="form-control" placeholder="Judul Tugas Akhir/Skipsi/Tesis" data-kt-autosize="true">{{ $bebaspustaka->judul }}</textarea>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-0">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Keterangan Pemberkasan</label>
                                    <!--begin::Label-->
                                    <!--begin::Label-->
                                    <div class="col-lg-8 d-flex align-items-center">
                                        <div class="form-check form-check-solid form-switch form-check-custom fv-row">
                                            @if($bebaspustaka->ket == "Selesai")
                                            <input class="form-check-input" name="ket" type="checkbox" value="Selesai" checked="checked">
                                            @else
                                            <input class="form-check-input" name="ket" type="checkbox" value="Selesai">
                                            @endif
                                            <span class="form-check-label fw-semibold text-muted">Selesai</span>
                                        </div>
                                    </div>
                                    <!--begin::Label-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Card body-->
                            <!--begin::Actions-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <a href="/admin/layanan-bebaspustaka" class="btn btn-light btn-active-light-primary me-2">Cancel</a>
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
