<!--begin::Modal - Tambah Non Tugas Akhir-->
<div class="modal fade" id="kt_modal_tambah_nonta" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-700px">
        <div class="modal-content">

            <!--begin::Header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
            </div>
            <!--end::Header-->

            <!--begin::Body-->
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">

                <form class="text-start" method="POST" enctype="multipart/form-data" action="{{ route('layanan-plagiasi.store') }}">
                    @csrf

                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <h1 class="mb-3">Tambah Non Tugas Akhir</h1>
                        <div class="text-muted fw-semibold fs-5">Layanan Cek Plagiasi</div>
                    </div>
                    <!--end::Heading-->

                    <!-- Nama -->
                    <div class="fv-row mb-7">
                        <label class="fw-semibold fs-6 mb-2 required">Nama</label>
                        <input type="text" name="nama" class="form-control mb-3 mb-lg-0" placeholder="Masukkan Nama" required>
                    </div>

                    <!-- Keterangan -->
                    <div class="fv-row mb-7">
                        <label class="fw-semibold fs-6 mb-2 required">Keterangan</label>
                        <input type="text" name="ket" class="form-control mb-3 mb-lg-0" placeholder="Masukkan Keterangan" required>
                        <div class="form-text">
                            Masukkan Keterangan seperti program studi/dosen atau identitas lainnya
                        </div>
                    </div>
                    <!-- Keterangan -->
                    <div class="fv-row mb-7">
                        <label class="fw-semibold fs-6 mb-2">Kontak(No.WA)</label>
                        <input type="text" name="kontak" class="form-control mb-3 mb-lg-0" placeholder="Masukkan No. What Apps">
                        <div class="form-text">
                            Kosongi jika tidak ada.
                        </div>
                    </div>

                    <!-- Judul -->
                    <div class="fv-row mb-7">
                        <label class="fw-semibold fs-6 mb-2 required">Judul Karya</label>
                        <textarea name="judul" class="form-control mb-3 mb-lg-0" placeholder="Masukkan Judul Karya" data-kt-autosize="true" required></textarea>
                    </div>
                    <input type="hidden" name="petugas" value="{{ auth()->user()->tempat }}">
                    <!-- File -->
                    <div class="fv-row mb-10">
                        <label class="fw-semibold fs-6 mb-2 required">File Karya</label>
                        <input type="file" name="file" class="form-control mb-3 mb-lg-0" required>
                    </div>

                    <!-- Action -->
                    <div class="text-center">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Simpan</span>
                            <span class="indicator-progress">
                                Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>

                </form>

            </div>
            <!--end::Body-->

        </div>
    </div>
</div>
<!--end::Modal-->