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
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Tambah Data Cek Plagiasi</h1>
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
                        <li class="breadcrumb-item text-muted">Tambah</li>
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
                                
                                <div id="formTugasAkhir">
                                    <div class="row mb-6">
                                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">NIM/ID Anggota</label>
                                        <!--end::Label-->
                                        <div class="col-lg-8 fv-row">
                                            <form id="mahasiswaForm">
                                                <input type="text" name="nim" id="nim" class="form-control" placeholder="Masukkan Nomor Induk Mahasiswa atau ID Anggota OPAC" required>
                                                <div class="form-text">Masukkan ID Anggota Perpustakaan untuk hasil yang lebih akurat</div>
                                                <button type="submit" class="btn btn-sm btn-light-primary mt-2">
                                                    <i class="ki-outline ki-plus fs-2"></i>Cek Keanggotaan Mahasiswa
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Form untuk Tugas Akhir -->
                                    <form id="kt_modal_update_details" class="form" method="POST" enctype="multipart/form-data" action="/admin/layanan-cekplagiasi">
                                        @csrf
                                        <!--end::Label-->
                                        <!--begin::Input group-->
                                        <div id="result"></div>
                                        <!--end::Input group-->

                                        <div class="separator mb-4"></div>


                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Dosen Pembimbing 1 Skripsi</label>
                                            <!--end::Label-->
                                            <div class="col-lg-8 fv-row">
                                                <select class="form-select" name="dosen_id" data-control="select2" data-hide-search="false" data-placeholder="Cari Dosen Pembimbing">
                                                    <option></option>
                                                    @foreach ($dosen as $item)
                                                    @if($item->nomor == null)
                                                    <option value="{{ $item->id }}">{{  $item->nidn. ' - ' .$item->nama }}</option>
                                                    @else
                                                    <option value="{{ $item->id }}">{{  $item->nidn. ' - ' .$item->nama }}*</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Dosen Pembimbing 2 Skripsi</label>
                                            <!--end::Label-->
                                            <div class="col-lg-8 fv-row">
                                                <select class="form-select" name="dosen2_id" data-control="select2" data-hide-search="false" data-placeholder="Cari Dosen Pembimbing">
                                                    <option></option>
                                                    @foreach ($dosen as $item)
                                                    @if($item->nomor == null)
                                                    <option value="{{ $item->id }}">{{  $item->nidn. ' - ' .$item->nama }}</option>
                                                    @else
                                                    <option value="{{ $item->id }}">{{  $item->nidn. ' - ' .$item->nama }}*</option>
                                                    @endif
                                                    @endforeach
                                                </select>
                                                <div class="form-text">Dosen yang ada tanda(*) akan menerima notifikasi hasil plagiasi</div>
                                            </div>
                                        </div>
                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Judul Karya</label>
                                            <div class="col-lg-8 fv-row">
                                                <textarea name="judul" class="form-control" placeholder="Masukkan Judul Karya" data-kt-autosize="true" required></textarea>
                                                @error('judul')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-6">
                                            <label class="col-lg-4 col-form-label fw-semibold fs-6">File Karya</label>
                                            <div class="col-lg-8 fv-row">
                                                <input type="file" name="file" class="form-control" required>
                                                @error('file')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="text-end mt-15">
                                            <a href="/admin/layanan-plagiasi" class="btn btn-light me-3">Kembali</a>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('admin.universitas.mahasiswa.tambah')
<script src="admin/assets/plugins/global/plugins.bundle.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ambil elemen radio buttons
        const tugasAkhirRadio = document.getElementById('tugasAkhir');
        const nonTugasAkhirRadio = document.getElementById('nonTugasAkhir');

        // Ambil elemen form
        const formTugasAkhir = document.getElementById('formTugasAkhir');
        const formNonTugasAkhir = document.getElementById('formNonTugasAkhir');

        // Fungsi untuk menampilkan atau menyembunyikan form
        function toggleForms() {
            if (tugasAkhirRadio.checked) {
                formTugasAkhir.classList.remove('d-none');
                formNonTugasAkhir.classList.add('d-none');
            } else if (nonTugasAkhirRadio.checked) {
                formTugasAkhir.classList.add('d-none');
                formNonTugasAkhir.classList.remove('d-none');
            }
        }

        // Tambahkan event listener pada perubahan nilai radio buttons
        tugasAkhirRadio.addEventListener('change', toggleForms);
        nonTugasAkhirRadio.addEventListener('change', toggleForms);

        // Panggil fungsi toggleForms saat halaman dimuat untuk mengatur tampilan awal
        toggleForms();
    });
</script>

 <script>
        document.getElementById('mahasiswaForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const nim = document.getElementById('nim').value;
            const url = `https://opac.lib.ibrahimy.ac.id/api/MahasiswaApiController.php?nim=${encodeURIComponent(nim)}&token=lib180597`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const resultDiv = document.getElementById('result');
                    if (data.status === 'success') {
                        const m = data.data;
                        resultDiv.innerHTML = `

            <div class="d-flex flex-stack fs-4 py-3">
				<div class="fw-bold rotate collapsible active">Data Mahasiswa</div>
			</div>
            <div class="separator mb-4"></div>
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label fw-semibold fs-6">NIM</label>
                <div class="col-lg-8 fv-row">
                    <input type="text" name="nim" class="form-control" placeholder="Masukkan NIM" value="${m.NIM}" required>
                    <div class="form-text">Nomor induk Mahasiswa(NIM) harus diisi jika kosong.</div>
                    @error('nim')
                        <small class="text-danger">Nomor Induk Mahasiswa Harus diisi</small>
                    @enderror
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label fw-semibold fs-6">Nama Mahasiswa</label>
                <div class="col-lg-8 fv-row">
                    <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama" value="${m.member_name}" readonly>
                    @error('nama')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label fw-semibold fs-6">Jenis Kelamin</label>
                <div class="col-lg-8 fv-row">
                    <input type="text" name="jk" class="form-control" placeholder="Masukkan Nama" value="${m.gender == 1 ? 'Putra' : 'Putri'}" readonly>
                    @error('nama')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label fw-semibold fs-6">Program Studi</label>
                <div class="col-lg-8 fv-row">
                    <input type="text" name="prodi" class="form-control" placeholder="Masukkan Prodi" value="${m.nm_prodi}" required readonly>
                    @error('prodi')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label fw-semibold fs-6">Kecamatan</label>
                <div class="col-lg-8 fv-row">
                    <input type="text" name="kecamatan" class="form-control" placeholder="Masukkan Kecamatan" value="${m.member_kecamatan}" readonly>
                </div>
            </div>

            <div class="row mb-6">
                <label class="col-lg-4 col-form-label fw-semibold fs-6">Kabupaten</label>
                <div class="col-lg-8 fv-row">
                    <input type="text" name="kabupaten" class="form-control" placeholder="Masukkan Kabupaten" value="${m.member_kabupaten}" readonly>
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label fw-semibold fs-6">Provinsi</label>
                <div class="col-lg-8 fv-row">
                    <input type="text" name="provinsi" class="form-control" placeholder="Masukkan Provinsi" value="${m.member_provinsi}" readonly>
                </div>
            </div>


                 `;
                    } else {
                        resultDiv.innerHTML = `<!--begin::Alert-->
                                                <div class="alert alert-danger border-danger border border-dashed d-flex align-items-center p-5">
                                                    <!--begin::Icon-->
                                                    <i class="ki-outline ki-information fs-2hx text-danger me-4"></i>
                                                    <!--end::Icon-->

                                                    <!--begin::Wrapper-->
                                                    <div class="d-flex flex-column">
                                                        <!--begin::Title-->
                                                        <h4 class="mb-1 text-danger">Data tidak ditemukan</h4>
                                                        <!--end::Title-->

                                                        <!--begin::Content-->
                                                        <span>Kemungkinan mahasiswa yang bersangkutan belum terdaftar di OPAC Perpustakaan Ibrahimy, Masukkan ID Anggota OPAC untuk hasil yang lebih akurat atau cek kembali di <a href="https://opac.lib.ibrahimy.ac.id/admin/index.php?mod=membership" target="_blank" class="text-hover-primary">Disini</a>.</span>
                                                        <!--end::Content-->
                                                    </div>
                                                    <!--end::Wrapper-->
                                                </div>
                                                <!--end::Alert-->`;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('result').innerHTML = 'Terjadi kesalahan saat memuat data.';
                });



        });
    </script>


@endsection



