<!--begin::Modal - Update user details-->
<div class="modal fade" id="kt_modal_add" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-800px">
        <!--begin::Modal content-->
        <div class="modal-content">
        <div class="modal-header pb-0 border-0 justify-content-end">
            <!--begin::Close-->
            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                <i class="ki-outline ki-cross fs-1">
                </i>
            </div>
            <!--end::Close-->
        </div>
        <!--begin::Modal header-->
        <!--begin::Modal body-->
        <div class="modal-body scroll-y px-15 px-lg-15 pt-0 pb-15">
            <!--begin:Form-->
            <form id="kt_modal_update_details" class="form" method="POST" enctype="multipart/form-data" action="/admin/layanan-bebaspustaka">
                @csrf
                <!--begin::Heading-->
                <div class="mb-13 text-center">
                    <!--begin::Title-->
                    <h1 class="mb-3">Tambah Mahasiswa</h1>
                    <div class="text-muted fw-semibold fs-5">Data Surat Bebas Pustaka</div>
                    <!--end::Title-->
                </div>
                <!--end::Heading-->
                <!--begin::Input group-->
                <div class="fv-row mb-8">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Tahun Lulusan</label>
                    <!--end::Label-->
                    <select class="form-select" name="angkatan" data-control="select2" data-hide-search="true" data-placeholder="Pilih Lulusan">
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
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-8">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Nomor Induk Mahasiswa</label>
                    <!--end::Label-->
                    <!--begin::Image placeholder-->
                    <input type="text" name="nim" class="form-control mb-3 mb-lg-0" placeholder="Nomor Induk Mahasiswa" required autocomplete="nim">
                    <!--end::Image input-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-8">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Nama Mahasiswa</label>
                    <!--end::Label-->
                    <!--begin::Image placeholder-->
                    <input type="text" name="nama" class="form-control mb-3 mb-lg-0" placeholder="Nama Mahasiswa" required autocomplete="nama">
                    <!--end::Image input-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-8">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Pendidikan Diniyah</label>
                    <!--end::Label-->
                    <!--begin::Image placeholder-->
                    <select class="form-select" name="pend_pagi" data-control="select2" data-hide-search="true" data-placeholder="Pilih Pendidikan Diniyah Terakhir" required autocomplete="pend_pagi">
                        <option></option>
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
                    <!--end::Image input-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-8">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Program Studi</label>
                    <!--end::Label-->
                    <!--begin::Image placeholder-->
                    <select name="prodi" class="form-select mb-2" data-control="select2" data-hide-search="false" data-placeholder="Pilih Program Studi" id="kt_ecommerce_add_product_status_select">
                        <option></option>
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
                    <!--end::Description-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-8">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Kecamatan(Alamat)</label>
                    <!--end::Label-->
                    <!--begin::Image placeholder-->
                    <input type="text" name="kecamatan" class="form-control mb-3 mb-lg-0" placeholder="Nama Kecamatan Asal" required autocomplete="kecamatan">
                    <!--end::Image input-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-8">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Kabupaten/Kota</label>
                    <!--end::Label-->
                    <!--begin::Image placeholder-->
                    <input type="text" name="kabupaten" class="form-control mb-3 mb-lg-0" placeholder="Nama Kabupaten/Kota Asal" required autocomplete="kabupaten">
                    <!--end::Image input-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-8">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Provinsi</label>
                    <!--end::Label-->
                    <!--begin::Image placeholder-->
                    <input type="text" name="provinsi" class="form-control mb-3 mb-lg-0" placeholder="Nama Provinsi/Asal" required autocomplete="provinsi">
                    <!--end::Image input-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-8">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Asrama</label>
                    <!--end::Label-->
                    <!--begin::Image placeholder-->
                    <input type="text" name="asrama" class="form-control mb-3 mb-lg-0" placeholder="Asrama" required autocomplete="asrama">
                    <!--end::Image input-->
                    <div class="form-text">Contoh Penulisan : A.01 (tanpa spasi) - Ketik 'Luaran' jika tidak pernah mondok</div>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-8">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Judul Tugas Akhir (Skripsi/Tesis)</label>
                    <!--end::Label-->
                    <!--begin::Image placeholder-->
                    <textarea name="judul" class="form-control" placeholder="Judul Tugas Akhir/Skipsi/Tesis" data-kt-autosize="true"></textarea>
                    <!--end::Image input-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="d-flex flex-stack mb-14">
                    <!--begin::Label-->
                    <div class="me-5">
                        <label class="fs-6 fw-semibold">Keterangan Pemberkasan</label>
                        <div class="fs-7 fw-semibold text-muted">Klik jika selesai pemberkasan di Perpustakaan</div>
                    </div>
                    <!--end::Label-->
                    <!--begin::Switch-->
                    <label class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input" name="ket" type="checkbox" value="Selesai" checked="checked">
                        <span class="form-check-label fw-semibold text-muted">Selesai</span>
                    </label>
                    <!--end::Switch-->
                </div>
                <!--end::Input group-->
                <div class="text-center">
                    <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                    {{--  <button class="btn btn-primary" >  --}}
                    <button type="submit" class="btn btn-primary">
                        <span class="indicator-label">Simpan</span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
            <!--end:Form-->
        </div>
        <!--end::Modal body-->

            <!--end::Form-->
        </div>
    </div>
</div>
<!--end::Modal - Update user details-->

<script src="admin/assets/plugins/global/plugins.bundle.js"></script>



<script src="admin/assets/js/custom/utilities/modals/bidding.js"></script>


{{-- @include('sweetalert::alert') --}}
