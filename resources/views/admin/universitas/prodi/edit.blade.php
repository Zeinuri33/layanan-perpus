<!--begin::Modal - Update user details-->
<div class="modal fade" id="kt_modal_edit{{ $item->id }}" tabindex="-1" aria-hidden="true">
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
            <form id="kt_modal_update_details" class="form" method="POST" enctype="multipart/form-data" action="{{ route('prodi.update', $item->id) }}">
                @csrf
                @method('PUT')
                <!--begin::Heading-->
                <div class="mb-13 text-center">
                    <!--begin::Title-->
                    <h1 class="mb-3">Program Studi {{ $item->prodi }}</h1>
                    <div class="text-muted fw-semibold fs-5">Fakultas {{ $item->fakultas }} Universitas Ibrahimy</div>
                    <!--end::Title-->
                </div>
                <!--end::Heading-->
                <!--begin::Input group-->
                <div class="fv-row mb-8">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Nama Program Studi</label>
                    <!--end::Label-->
                    <!--begin::Image placeholder-->
                    <input type="text" name="prodi" class="form-control mb-3 mb-lg-0" placeholder="Masukkan Nama Program Studi" value="{{ $item->prodi }}" readonly required>
                    <!--end::Image input-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-8">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Kode Program Studi</label>
                    <!--end::Label-->
                    <!--begin::Image placeholder-->
                    <input type="text" name="kode" class="form-control mb-3 mb-lg-0" placeholder="Masukkan Kode Program Studi" value="{{ $item->kode }}" required>
                    <!--end::Image input-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-8">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Fakultas</label>
                    <!--end::Label-->
                    <!--begin::Image placeholder-->
                    <select class="form-select" name="fakultas" data-control="select2" data-hide-search="true" data-placeholder="Pilih Fakultas" required>
                        <option value="{{ $item->fakultas }}">{{ $item->fakultas }}</option>
                        <option value="Syariah dan Ekonomi Islam">Syariah dan Ekonomi Islam</option>
                        <option value="Dakwah">Dakwah</option>
                        <option value="Tarbiyah">Tarbiyah</option>
                        <option value="Sains dan Teknologi">Sains dan Teknologi</option>
                        <option value="Sosial dan Humaniora">Sosial dan Humaniora</option>
                        <option value="Ilmu Kesehatan">Ilmu Kesehatan</option>
                    </select>
                    <!--end::Image input-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-12">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Kontak Program Studi</label>
                    <!--end::Label-->
                    <!--begin::Image placeholder-->
                    <input type="text" name="kontak" class="form-control mb-3 mb-lg-0" placeholder="Masukkan Kontak Program Studi" value="{{ $item->kontak }}">
                    <!--end::Image input-->
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


