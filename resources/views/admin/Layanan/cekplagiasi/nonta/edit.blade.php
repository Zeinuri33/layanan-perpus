<!--begin::Modal - Edit Non Tugas Akhir-->
<div class="modal fade" id="kt_modal_edit_nonta{{ $item->id }}" tabindex="-1" aria-hidden="true">
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
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15 text-start">

                <form method="POST" enctype="multipart/form-data" action="{{ route('layanan-plagiasi.update', $item->id) }}">
                    @csrf
                    @method('PUT')

                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <h1 class="mb-3">Edit Non Tugas Akhir</h1>
                        <div class="text-muted fw-semibold fs-5">Layanan Cek Plagiasi</div>
                    </div>
                    <!--end::Heading-->

                    <!-- Nama -->
                    <div class="fv-row mb-7">
                        <label class="fw-semibold fs-6 mb-2 required text-start">Nama</label>
                        <input type="text" name="nama" class="form-control" 
                               value="{{ $item->nama }}" 
                               placeholder="Masukkan nama lengkap" required>
                    </div>

                    <!-- Keterangan -->
                    <div class="fv-row mb-7">
                        <label class="fw-semibold fs-6 mb-2 required text-start">Keterangan</label>
                        <input type="text" name="ket" class="form-control" 
                               value="{{ $item->ket }}" 
                               placeholder="Contoh: Prodi TI / Dosen / Umum" required>
                        <div class="form-text">
                            Program studi / dosen / identitas lainnya
                        </div>
                    </div>

                    <!-- Kontak -->
                    <div class="fv-row mb-7">
                        <label class="fw-semibold fs-6 mb-2 text-start">Kontak (No. WA)</label>
                        <input type="text" name="kontak" class="form-control" 
                               value="{{ $item->kontak }}" 
                               placeholder="Contoh: 081234567890">
                    </div>

                    <!-- Judul -->
                    <div class="fv-row mb-7">
                        <label class="fw-semibold fs-6 mb-2 required text-start">Judul Karya</label>
                        <textarea name="judul" class="form-control" required
                                  placeholder="Masukkan judul karya">{{ $item->judul }}</textarea>
                    </div>

                    <!-- Hidden petugas -->
                    <input type="hidden" name="petugas" value="{{ auth()->user()->tempat }}">

                    <!-- File lama -->
                    <div class="fv-row mb-7">
                        <label class="fw-semibold fs-6 mb-2 text-start">File Saat Ini</label><br>
                        @if($item->file)
                            <span class="badge badge-light-success">
                                {{ basename($item->file) }}
                            </span>
                        @else
                            <span class="text-muted">Tidak ada file</span>
                        @endif
                    </div>

                    <!-- Upload file baru -->
                    <div class="fv-row mb-10">
                        <label class="fw-semibold fs-6 mb-2 text-start">Upload File Baru</label>
                        <input type="file" name="file" class="form-control"
                               placeholder="Pilih file baru jika ingin mengganti">
                        <div class="form-text">
                            Kosongkan jika tidak ingin mengganti file
                        </div>
                    </div>

                    <!-- Action -->
                    <div class="text-center">
                        <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Simpan</span>
                        </button>
                    </div>

                </form>

            </div>
            <!--end::Body-->

        </div>
    </div>
</div>
<!--end::Modal-->