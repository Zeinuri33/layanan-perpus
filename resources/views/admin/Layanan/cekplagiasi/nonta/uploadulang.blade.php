<!--begin::Modal - Upload Ulang Dokumen-->
<div class="modal fade" id="kt_modal_upload{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-600px">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
            </div>

            <!-- Body -->
            <div class="modal-body scroll-y px-15 px-lg-15 pt-0 pb-15 text-start">
                
                <form method="POST" enctype="multipart/form-data" action="{{ route('nonta.uploadulang', $item->id) }}">
                    @csrf

                    @php
                        $nextUpdate = ($item->update_count ?? 1) + 1;
                    @endphp

                    <!-- Heading -->
                    <div class="mb-8 text-center">
                        <h1 class="mb-3">Upload Ulang Dokumen</h1>
                        <div class="fw-semibold fs-5">
                            Cek Plagiasi {{ $item->nama }} ke-{{ $nextUpdate }}
                        </div>
                    </div>

                    <!-- File -->
                    <div class="fv-row mb-12">
                        <label class="required fw-semibold fs-6 mb-2 text-start">
                            Upload File Karya ke-{{ $nextUpdate }}
                        </label>
                        <input 
                            type="file" 
                            name="file" 
                            class="form-control mb-3 mb-lg-0" 
                            required
                        >
                        <div class="form-text">
                            File lama & hasil akan dihapus otomatis
                        </div>
                    </div>

                    <!-- Action -->
                    <div class="text-center">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-warning">
                            <span class="indicator-label">Upload Ulang</span>
                            <span class="indicator-progress">
                                Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>