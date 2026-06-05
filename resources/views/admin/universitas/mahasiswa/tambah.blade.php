<!--begin::Modal - Update user details-->
<div class="modal fade" id="kt_modal_tambah" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-700px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 psb-15">
                <!--begin:Form-->
                <form class="text-start" method="POST" enctype="multipart/form-data" action="/admin/mahasiswa">
                @csrf
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">Tambah Mahasiswa</h1>
                        <div class="text-muted fw-semibold fs-5">Universitas Ibrahimy</a>.</div>
                        <!--end::Title-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fw-semibold fs-6 mb-2 required">Angkatan</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <select name="angkatan" class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Pilih Angkatan" required>
                            <option></option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022" selected>2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                        </select>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fw-semibold fs-6 mb-2 required">NIM</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" name="nim" placeholder="Nomor Induk Mahasiswa" class="form-control mb-3 mb-lg-0" required>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fw-semibold fs-6 mb-2 required">Nama</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" name="nama" placeholder="Nama Dosen" class="form-control mb-3 mb-lg-0" required>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fw-semibold fs-6 mb-2 required">Program Studi</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <select name="prodi" class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Pilih Program Studi" required>
                            <option></option>
                            <optgroup label="Fakultas Syariah dan Ekonomi Islam">
                                <option value="Hukum Keluarga Islam">Hukum Keluarga Islam</option>
                                <option value="Hukum Ekonomi Syariah">Hukum Ekonomi Syariah</option>
                                <option value="Manajemen Bisnis Syariah">Manajemen Bisnis Syariah</option>
                                <option value="Ekonomi Syariah">Ekonomi Syariah</option>
                                <option value="Akuntansi Syariah">Akuntansi Syariah</option>
                            </optgroup>
                            <optgroup label="Fakultas Dakwah">
                                <option value="Bimbingan Penyuluhan Islam">Bimbingan Penyuluhan Islam</option>
                                <option value="Komunikasi Penyiaran Islam">Komunikasi Penyiaran Islam</option>
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
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fw-semibold fs-6 mb-2 ">Kecamatan</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" name="kecamatan" placeholder="Alamat Kecamatan" class="form-control mb-3 mb-lg-0">
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fw-semibold fs-6 mb-2 ">Kabupaten</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" name="kabupaten" placeholder="Alamat Kabupaten" class="form-control mb-3 mb-lg-0">
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-16">
                        <!--begin::Label-->
                        <label class="fw-semibold fs-6 mb-2 ">Provinsi</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" name="provinsi" placeholder="Alamat Provinsi" class="form-control mb-3 mb-lg-0">
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <div class="text-center">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                        {{-- <button class="btn btn-primary" >  --}}
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Simpan</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>
            </div>
            <!--end::Modal body-->
            <!--end::Form-->
        </div>
    </div>
</div>
<!--end::Modal - Update user details-->

<script src="assets/plugins/global/plugins.bundle.js"></script>


<script src="assets/js/custom/utilities/modals/bidding.js"></script>



