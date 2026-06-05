<!--begin::Modal - Update user details-->
<div class="modal fade" id="kt_modal_upload{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-600px">
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
        <div class="modal-body scroll-y px-15 px-lg-15 pt-0 pb-15 text-start">
            <!--begin:Form-->
            <form id="kt_modal_update_details" class="form" method="POST" enctype="multipart/form-data" action="{{ asset('admin/layanan-cekplagiasi/'.$item->id.'/upload-ulang') }}">
                @csrf
                <!--begin::Heading-->
                <div class="mb-8 text-center">
                    <h1 class="mb-3">Upload Ulang Dokumen</h1>
                    <div class="fw-semibold fs-5">
                        Cek Plagiasi {{ $item->nama ?? $item->mahasiswa->nama ?? 'tidak ditemukan' }} yang ke {{ $item->riwayatPlagiasi->count() + 1 }}
                    </div>
                </div>
                <div class="fv-row mb-12">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2 ">Upload File Karya Cek Plagasi ke-{{ $item->riwayatPlagiasi->count() + 1 }}</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="file" name="file" class="form-control mb-3 mb-lg-0" placeholder="Upload File Karya" required>
                    <!--end::Input-->
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


{{--  --}}
