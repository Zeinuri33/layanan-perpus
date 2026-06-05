<!--begin::Modal - Update user details-->
<div class="modal fade" id="kt_modal_edit{{ $item->id }}" tabindex="-1" aria-hidden="true">
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
            <form id="kt_modal_update_details" class="form" method="POST" enctype="multipart/form-data" action="{{ route('layanan-kartu.update', $item->id) }}">
                @csrf
                @method('PUT')
                <!--begin::Heading-->
                <div class="mb-8 text-center">
                    <!--begin::Title-->
                    @php
                        $currentTime = Carbon\Carbon::now(); // Mendapatkan waktu saat ini
                        $hour = $currentTime->hour;   // Mendapatkan jam (0-23)
                    @endphp
                    <h1 class="mb-3">{{ $item->nama }}</h1>
                    @if($hour >= 13 && $hour < 17)
                    <div class="text-muted fw-semibold fs-5">Edit data anggota kartu pada shif siang.</div>
                    @elseif($hour >= 20 && $hour < 22)
                    <div class="text-muted fw-semibold fs-5">Edit data anggota kartu pada shif malam.</div>
                    @else
                    <div class="text-muted fw-semibold fs-5">Edit data anggota kartu di luar jam kerja.</div>
                    @endif
                    <!--end::Title-->
                </div>
                <div class="fv-row mb-8">
                    @if(request()->is('admin/layanan-kartu(Putra)'))
                    <input type="radio" class="btn-check" name="jk" value="Putra" checked>
                    @elseif(request()->is('admin/layanan-kartu(Putri)'))
                    <input type="radio" class="btn-check" name="jk" value="Putri" checked>
                    @else
                    <div class="mb-3">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-5 fw-semibold">
                            <span class="required">Pilih Tipe Anggota</span>

                            <span class="m2-1" data-bs-toggle="tooltip" title="Anda bisa memilih salah satu di bawah ini">
                                <i class="ki-outline ki-information fs-7"></i>
                            </span>
                        </label>
                        <!--end::Label-->

                        <!--begin::Description-->
                        <div class="fs-7 fw-semibold text-muted">Anda bisa men-klik salah satu di bawah ini untuk memilih</div>
                        <!--end::Description-->
                    </div>
                    @if($item->jk == "Putra")
                    <div class="btn-group w-100 mb-lg-0" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                        <!--begin::Radio-->
                        <label class="btn btn-outline btn-color-muted btn-active-primary active" data-kt-button="true">
                            <!--begin::Input-->
                            <input class="btn-check" type="radio" name="jk" value="Putra" required autocomplete="jk" checked="checked"/>
                            <!--end::Input-->
                            Anggota Putra
                        </label>
                        <!--end::Radio-->
                        <!--begin::Radio-->
                        <label class="btn btn-outline btn-color-muted btn-active-danger" data-kt-button="true">
                            <!--begin::Input-->
                            <input class="btn-check" type="radio" name="jk" value="Putri" required autocomplete="jk"/>
                            <!--end::Input-->
                            Anggota Putri
                        </label>
                        <!--end::Radio-->
                    </div>
                    @elseif($item->jk == "Putri")
                    <div class="btn-group w-100 mb-lg-0" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                        <!--begin::Radio-->
                        <label class="btn btn-outline btn-color-muted btn-active-primary" data-kt-button="true">
                            <!--begin::Input-->
                            <input class="btn-check" type="radio" name="jk" value="Putra" required autocomplete="jk" />
                            <!--end::Input-->
                            Anggota Putra
                        </label>
                        <!--end::Radio-->
                        <!--begin::Radio-->
                        <label class="btn btn-outline btn-color-muted btn-active-danger active" data-kt-button="true">
                            <!--begin::Input-->
                            <input class="btn-check" type="radio" name="jk" value="Putri" required autocomplete="jk" checked="checked"/>
                            <!--end::Input-->
                            Anggota Putri
                        </label>
                        <!--end::Radio-->
                    </div>
                    @endif
                    @endif
                </div>
                <!--end::Radio group-->
                <div class="fv-row mb-8">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">ID Anggota OPAC</label>
                    <!--end::Label-->
                    <!--begin::Image placeholder-->
                    <input type="text" name="idanggota" value="{{ $item->idanggota }}" class="form-control mb-3 mb-lg-0" placeholder="ID Anggota OPAC" required autocomplete="idanggota">
                    <!--end::Image input-->
                    <!--begin::Hint-->
                    <div class="form-text">Diambilkan dari ID Anggota pada sistem OPAC Perpustakaan Ibrahimy</div>
                    <!--end::Hint-->
                </div>
                <div class="fv-row mb-8">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Nama Anggota</label>
                    <!--end::Label-->
                    <!--begin::Image placeholder-->
                    <input type="text" name="nama" value="{{ $item->nama }}" class="form-control mb-3 mb-lg-0" placeholder="Nama Anggota" required autocomplete="nama">
                    <!--end::Image input-->
                    <!--begin::Hint-->
                    <div class="form-text">Ditulis dengan kapital depan; contoh: Ahmad Zaid</div>
                    <!--end::Hint-->
                </div>
                <div class="fv-row mb-8">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Asrama</label>
                    <!--end::Label-->
                    <!--begin::Image placeholder-->
                    <input type="text" name="asrama" value="{{ $item->asrama }}" class="form-control mb-3 mb-lg-0" placeholder="Asrama(kode)" required autocomplete="asrama">
                    <!--end::Image input-->
                    <!--begin::Hint-->
                    <div class="form-text">Contoh Penulisan : A.01 (tanpa spasi)</div>
                    <!--end::Hint-->
                </div>
                <div class="fv-row mb-8">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Kategori</label>
                    <!--end::Label-->
                    <select class="form-select" name="kategori" data-control="select2" data-hide-search="true" data-placeholder="Pilih Kategori Cetak">
                        <option value="{{ $item->kategori }}">{{ $item->kategori }}</option>
                        <option value="Anggota Baru">Anggota Baru</option>
                        <option value="Perpanjang/Cetak Ulang">Perpanjang/Cetak Ulang</option>
                        <option value="Mahasiswa Baru">Mahasiswa Baru</option>
                    </select>
                </div>
                <div class="fv-row mb-8">
                    <!--begin::Label-->
                    <label class="required fw-semibold fs-6 mb-2">Petugas</label>
                    <!--end::Label-->
                    <select class="form-select" name="petugas" data-control="select2" data-hide-search="true" data-placeholder="Pilih Petugas">
                        <option value="{{ $item->petugas }}">{{ $item->petugas }}</option>
                        @if(request()->is('admin/layanan-kartu(Putra)'))
                        <option value="Slamet">Slamet</option>
                        <option value="Harif">Harif</option>
                        <option value="Syamsuddin">Syamsuddin</option>
                        <option value="Lukman">Lukman</option>
                        <option value="Mustofa">Mustofa</option>
                        <option value="Mahmudi">Mahmudi</option>
                        <option value="Hasyim">Hasyim</option>
                        <option value="Muhammad">Muhammad</option>
                        <option value="Abadi">Abadi</option>
                        <option value="Syaikhoni">Syaikhoni</option>
                        @else
                        <option value="Farah Lailatul Maulida">Farah Lailatul Maulida</option>
                        <option value="Mimin Putri Alfiyani">Mimin Putri Alfiyani</option>
                        <option value="Camelia Putri Amalia">Camelia Putri Amalia</option>
                        <option value="Laila Nur Yasmin">Laila Nur Yasmin</option>
                        @endif
                    </select>
                </div>
                <input type="radio" class="btn-check" name="shif" value="{{ $item->shif }}" checked>
                <div class="d-flex flex-stack mb-14">
                    <!--begin::Label-->
                    <div class="me-5">
                        <label class="fs-6 fw-semibold">Keterangan Cetak</label>
                        <div class="fs-7 fw-semibold text-muted">Klik jika kartu selesai dicetak</div>
                    </div>
                    <!--end::Label-->
                    <!--begin::Switch-->
                    <label class="form-check form-switch form-check-custom form-check-solid">
                        @if($item->ket == "Selesai")
                        <input class="form-check-input" name="ket" type="checkbox" value="Selesai" checked="checked">
                        @else
                        <input class="form-check-input" name="ket" type="checkbox" value="Selesai">
                        @endif
                        <span class="form-check-label fw-semibold text-muted">Tercetak</span>
                        <input type="radio" class="btn-check" name="slug1" value="{{ Carbon\Carbon::parse($item->created_at)->isoFormat('MMMM-Y') }}" checked>
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


{{--  --}}
