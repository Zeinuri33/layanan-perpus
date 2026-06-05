<!--begin::Modal - Update user details-->
<div class="modal fade" id="kt_modal_edit{{ $item->id }}" tabindex="-1" aria-hidden="true">
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
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <!--begin:Form-->
                <form class="form text-start" method="POST" enctype="multipart/form-data" action="{{ route('kasir-produk.update', $item->id) }}">
                    @csrf
                    @method('PUT')
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">{{ $item->produk }}</h1>
                        <div class="text-muted fw-semibold fs-5">Layanan Kasir Perpustakaan Ibrahimy</a>.</div>
                        <!--end::Title-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2">Nama Produk</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" name="produk" class="form-control mb-3 mb-lg-0" placeholder="Nama Produk" value="{{ $item->produk }}" required>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fw-semibold fs-6 mb-2">Kategori Produk</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <select class="form-select" name="kategori" data-control="select2" data-hide-search="true" data-placeholder="Pilih Kategori Produk">
                            <option value="" {{ old('kategori', $item->kategori ?? '') === '' ? 'selected' : '' }}>Tidak Ada Kategori</option>
                            <option value="Print" {{ old('kategori', $item->kategori ?? '') === 'Print' ? 'selected' : '' }}>Print</option>
                            <option value="Foto Copy" {{ old('kategori', $item->kategori ?? '') === 'Foto Copy' ? 'selected' : '' }}>Foto Copy</option>
                        </select>
                        <div class="form-text">Kosongi bila tidak perlu</div>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="fw-semibold fs-6 mb-2">Satuan</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" name="satuan" class="form-control mb-3 mb-lg-0" placeholder="Satuan Produk" value="{{ $item->satuan }}">
                        <!--end::Input-->
                        <div class="form-text">Seperti: Lembar, Buah dan lain sebagainya.</div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-2">Harga Satuan</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="number" name="harga" class="form-control mb-3 mb-lg-0" placeholder="Harga Satuan Produk" value="{{ $item->harga }}" required>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="d-flex flex-stack mb-14">
                        <!--begin::Label-->
                        <div class="me-5">
                            <label class="fs-6 fw-semibold">Stok Produk</label>
                            <div class="fs-7 fw-semibold text-muted">Aktifkan jika masih ada</div>
                        </div>
                        <!--end::Label-->

                        <!--begin::Switch-->
                        <label class="form-check form-switch form-check-custom form-check-solid">
                            <!-- Hidden fallback -->
                            <input type="hidden" name="stok" value="Habis">

                            <!-- Checkbox utama -->
                            <input class="form-check-input" name="stok" type="checkbox" value="Ada"
                                {{ old('stok', $item->stok ?? '') === 'Ada' ? 'checked' : '' }}>
                            <span class="form-check-label fw-semibold text-muted">Ada</span>
                        </label>
                        <!--end::Switch-->

                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="text-center">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Simpan</span>
                            <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>
                <!--end:Form-->
            </div>
        </div>
    </div>
</div>


<script>
    $(function() {
        $('[data-control="select2"]').select2({
            placeholder: "Pilih Kategori Produk",
            allowClear: true
        });
    });

</script>