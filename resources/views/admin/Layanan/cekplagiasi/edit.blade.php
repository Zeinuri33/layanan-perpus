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
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">{{ $plagiasi->mahasiswa->nama ?? $plagiasi->nama }}</h1>
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
                            <a href="admin/layanan-cekplagiasi" class="text-muted text-hover-primary">Data Cek Plagiasi</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Edit</li>
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
                <div class="row g-xxl-9">
                    <div class="col-xl-12">
                        <div class="card card-flush h-xl-100">
                            <div class="card-body">
                                <div class="d-flex flex-stack">
                                    <div class="fw-bold fs-4">Form Cek Plagiasi</div>
                                </div>
                                <div class="separator my-8"></div>

                                @if($plagiasi->nama)
                                    <!-- Form untuk Non Tugas Akhir -->
                                    <form id="kt_modal_update_details" class="form" method="POST" enctype="multipart/form-data" action="{{ asset('/admin/layanan-cekplagiasi/'.$plagiasi->id.'/perbarui') }}">
                                        @csrf
                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Nama</label>
                                            <!--end::Label-->
                                            <div class="col-lg-8 fv-row">
                                                <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama" value="{{ $plagiasi->nama }}" required>
                                            </div>
                                        </div>
                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Keterangan</label>
                                            <!--end::Label-->
                                            <div class="col-lg-8 fv-row">
                                                <input type="text" name="ket" value="{{ $plagiasi->ket }}" class="form-control" placeholder="Masukkan Keterangan">
                                                <div class="form-text">Masukkan Keterangan seperti program Studi/dosen atau identitas lainnya</div>
                                            </div>
                                        </div>

                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6 required">Judul Karya</label>
                                            <div class="col-lg-8 fv-row">
                                                <textarea name="judul" class="form-control" placeholder="Masukkan Judul Karya" data-kt-autosize="true" required>{{ $plagiasi->judul }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">File Karya</label>
                                            <div class="col-lg-8 fv-row">
                                                <input type="file" name="file" class="form-control" placeholder="Upload File Karya">
                                            </div>
                                        </div>
                                        <div class="text-end mt-15">
                                            <a href="admin/layanan-cekplagiasi" class="btn btn-light me-3">Kembali</a>
                                            {{--  <button class="btn btn-primary" >  --}}
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                        <!-- Tambahkan elemen form lainnya sesuai kebutuhan -->
                                    </form>
                                    <!-- Form untuk Tugas Akhir -->
                                @else
                                    <form id="kt_modal_update_details" class="form" method="POST" enctype="multipart/form-data" action="{{ route('layanan-cekplagiasi.update', $plagiasi->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <!--end::Label-->
                                        <!--begin::Input group-->
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Nomor Induk Mahasiswa</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8 fv-row">
                                                <input type="text" name="nim" value="{{ $plagiasi->mahasiswa->nim }}" class="form-control mb-3 mb-lg-0" placeholder="Nomor Induk Mahasiswa" required autocomplete="nim" readonly>
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
                                                <input type="text" name="nama" value="{{ $plagiasi->mahasiswa->nama }}" class="form-control mb-3 mb-lg-0" placeholder="Nama Mahasiswa" required autocomplete="nama">
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
                                                <input type="text" value="{{ $plagiasi->mahasiswa->prodi }}" class="form-control mb-3 mb-lg-0" placeholder="Program Studi" readonly>
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row mb-6">
                                            <!--begin::Label-->
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Fakultas</label>
                                            <!--end::Label-->
                                            <!--begin::Col-->
                                            <div class="col-lg-8 fv-row">
                                                <input type="text" value="{{ $plagiasi->mahasiswa->programstudi->fakultas ?? '-' }}" class="form-control mb-3 mb-lg-0" placeholder="Program Studi" readonly>
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
                                                <input type="text" name="kecamatan" value="{{ $plagiasi->mahasiswa->kecamatan }}" class="form-control mb-3 mb-lg-0" placeholder="Nama Kecamatan Asal" required autocomplete="kecamatan">
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
                                                <input type="text" name="kabupaten" value="{{ $plagiasi->mahasiswa->kabupaten }}" class="form-control mb-3 mb-lg-0" placeholder="Nama Kabupaten/Kota Asal" required autocomplete="kabupaten">
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
                                                <input type="text" name="provinsi" value="{{ $plagiasi->mahasiswa->provinsi }}" class="form-control mb-3 mb-lg-0" placeholder="Nama Provinsi/Asal" required autocomplete="provinsi">
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Input group-->
                                        <div class="separator mb-6"></div>
                                        <!--end::Input group-->
                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Dosen Pembimbing I Tugas Akhir</label>
                                            <!--end::Label-->
                                            <div class="col-lg-8 fv-row">
                                                <select class="form-select" name="dosen_id" data-control="select2" data-hide-search="false" data-placeholder="Cari Dosen Pembimbing">
                                                    <option value="{{ $plagiasi->dosen_id }}">
                                                        {{ ($plagiasi->dosen->nidn ?? '-') . ' - ' . ($plagiasi->dosen->nama ?? '-') }}
                                                    </option>

                                                    @foreach ($dosen as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->nidn . ' - ' . $item->nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Dosen Pembimbing 2 Tugas Akhir</label>
                                            <!--end::Label-->
                                            <div class="col-lg-8 fv-row">
                                                <select class="form-select" name="dosen2_id" data-control="select2" data-hide-search="false" data-placeholder="Cari Dosen Pembimbing">
                                                    <option value="{{ $plagiasi->dosen2_id }}">
                                                        {{ ($plagiasi->dosen2->nidn ?? '-') . ' - ' . ($plagiasi->dosen2->nama ?? '-') }}
                                                    </option>
                                                    @foreach ($dosen as $item)
                                                    <option value="{{ $item->id }}">{{  $item->nidn. ' - ' .$item->nama }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="form-text">Dosen yang ada tanda(*) akan menerima notifikasi hasil plagiasi</div>
                                            </div>
                                        </div>
                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6 required">Judul Karya</label>
                                            <div class="col-lg-8 fv-row">
                                                <textarea name="judul" class="form-control" placeholder="Judul Tugas Akhir/Skipsi/Tesis" data-kt-autosize="true">{{ $plagiasi->judul }}</textarea>
                                            </div>
                                        </div>
                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">File Karya</label>
                                            <div class="col-lg-8 fv-row">
                                                <input type="file" name="file" class="form-control" placeholder="Upload File Karya">
                                            </div>
                                        </div>
                                        <div class="text-end mt-15">
                                            <a href="admin/layanan-cekplagiasi" class="btn btn-light me-3">Kembali</a>
                                            {{--  <button class="btn btn-primary" >  --}}
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="admin/assets/plugins/global/plugins.bundle.js"></script>



@endsection
