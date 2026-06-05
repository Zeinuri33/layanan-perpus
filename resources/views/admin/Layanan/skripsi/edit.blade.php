<!--begin::Modal - Edit Skripsi-->
<div class="modal fade" id="kt_modal_edit{{ $item->id }}" tabindex="-1" aria-hidden="true">
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

                <form class="text-start"
                    method="POST"
                    enctype="multipart/form-data"
                    action="{{ route('skripsi.update', $item->id) }}">

                    @csrf
                    @method('PUT')

                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <h1 class="mb-3">Edit</h1>

                        <div class="text-muted fw-semibold fs-5">
                            Layanan Katalog Skripsi
                        </div>
                    </div>
                    <!--end::Heading-->

                    <!-- Judul -->
                    <div class="fv-row mb-7">
                        <label class="fw-semibold fs-6 mb-2 required">
                            Judul
                        </label>

                        <textarea
                            name="judul"
                            class="form-control mb-3 mb-lg-0"
                            placeholder="Masukkan Judul Skripsi"
                            data-kt-autosize="true"
                            required
                        >{{ $item->judul }}</textarea>
                    </div>

                    <!-- Label -->
                    <div class="fv-row mb-7">
                        <label class="fw-semibold fs-6 mb-2 required">
                            Label
                        </label>

                        <input
                            type="text"
                            name="label"
                            class="form-control mb-3 mb-lg-0"
                            placeholder="Masukkan Label"
                            value="{{ $item->label }}"
                            required
                        >

                        <div class="form-text">
                            Contoh Penulisan. TI.24.030
                            (TI=Kode Prodi, 24=Tahun Lulusan, 030=Tiga Angka terakhir NIM)
                        </div>
                    </div>

                    <!-- Pengarang -->
                    <div class="fv-row mb-7">
                        <label class="fw-semibold fs-6 mb-2 required">
                            Pengarang
                        </label>

                        <input
                            type="text"
                            name="pengarang"
                            class="form-control mb-3 mb-lg-0"
                            placeholder="Masukkan Nama Pengarang"
                            value="{{ $item->pengarang }}"
                            required
                        >
                    </div>

                    <!-- NIM -->
                    <div class="fv-row mb-7">
                        <label class="fw-semibold fs-6 mb-2 required">
                            NIM
                        </label>

                        <input
                            type="text"
                            name="nim"
                            class="form-control mb-3 mb-lg-0"
                            placeholder="Masukkan NIM"
                            value="{{ $item->nim }}"
                            required
                        >
                    </div>

                    <!-- Prodi -->
                    <div class="fv-row mb-7">
                        <label class="fw-semibold fs-6 mb-2 required">
                            Program Studi
                        </label>

                        <select
                            name="prodi_id"
                            class="form-select"
                            data-control="select2"
                            data-placeholder="Pilih Program Studi"
                            required
                        >
                            <option></option>

                            @foreach ($prodi as $prodis)
                                <option
                                    value="{{ $prodis->id }}"
                                    {{ $item->prodi_id == $prodis->id ? 'selected' : '' }}
                                >
                                    {{ $prodis->prodi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Lulusan -->
                    <div class="fv-row mb-7">
                        <label class="fw-semibold fs-6 mb-2 required">
                            Lulusan
                        </label>

                        <select
                            name="lulusan"
                            class="form-select"
                            data-control="select2"
                            data-placeholder="Pilih Tahun Lulusan"
                            required
                        >
                            @php
                                $tahunSekarang = date('Y');
                            @endphp

                            @for ($tahun = $tahunSekarang + 5; $tahun >= $tahunSekarang - 5; $tahun--)
                                <option
                                    value="{{ $tahun }}"
                                    {{ $item->lulusan == $tahun ? 'selected' : '' }}
                                >
                                    {{ $tahun }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <!-- Action -->
                    <div class="text-center">
                        <button
                            type="reset"
                            class="btn btn-light me-3"
                            data-bs-dismiss="modal"
                        >
                            Cancel
                        </button>

                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">
                                Simpan
                            </span>

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
