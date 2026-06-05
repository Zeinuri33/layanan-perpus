<!--begin::Modal - Update user details-->
<div class="modal fade" id="kt_modal_detail{{ $item->id }}" tabindex="-1" aria-hidden="true">
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
            <!--begin::Heading-->
            <div class="mb-8 text-center">
                <!--begin::Title-->
                <h1 class="mb-3">{{ $item->nama ?? $item->mahasiswa->nama ?? 'tidak ditemukan' }}</h1>
                <div class="fw-semibold fs-5">
                    {{ $item->nama ? ($item->ket ?? 'tidak ditemukan') : ('Mahasiswa Semester Akhir ' . ($item->mahasiswa->prodi ?? 'tidak ditemukan')) }}
                </div>
                <!--end::Title-->
            </div>
            <div class="mb-8 text-center">
                <h3 class="align-items-start flex-column">
                    <div class="badge py-3 px-4 fs-7 badge-light-primary mb-2">Judul Karya</div>
                    <div class="fw-semibold fs-5">{{ $item->judul }}</div>
                </h3>
            </div>
            @if(auth()->user()->hasPermissionTo('layanan cekplagiasi-file'))
            <div class="mb-8">
                <div class="notice d-flex bg-light-primary rounded border border-primary flex-shrink-0 p-6">
                    <!--begin::Icon-->
                    <img class="w-50px me-3" src="{{ ('admin/assets/media/svg/files/doc.svg') }}">
                    <!--end::Icon-->
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                        <!--begin::Content-->
                        <div class="mb-3 mb-md-0 fw-semibold">
                            <h4 class="text-gray-900 fw-bold" 
                                style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 250px; display: inline-block;">
                                {{ basename($item->file) }}
                            </h4>
                            <div class="fs-6 text-gray-700 pe-7">File Dokumen Karya</div>
                        </div>
                        <!--end::Content-->
                        <!--begin::Action-->
                        <a href="{{ route('plagiasi.download', $item->id) }}" class="btn btn-primary px-6 align-self-center text-nowrap">Download</a>
                        <!--end::Action-->
                    </div>
                    <!--end::Wrapper-->
                </div>
            </div>
            @endif
            <div class="mb-8">
                <div class="text-center mb-5">
                    <div class="badge py-3 px-4 fs-7 badge-light-primary">Riwayat Cek Plagiasi</div>
                </div>
                <!--begin::Timeline-->
				<div class="timeline timeline-border-dashed">
					@foreach ($item->riwayatPlagiasi as $riwayat)
					<!--begin::Timeline item-->
					<div class="timeline-item">
						<!--begin::Timeline line-->
						<div class="timeline-line"></div>
						<!--end::Timeline line-->
						<!--begin::Timeline icon-->
						<div class="timeline-icon">
							<i class="ki-outline ki-pencil fs-2 text-gray-500">
							</i>
						</div>
						<!--end::Timeline icon-->
						<!--begin::Timeline content-->
						<div class="timeline-content">
							<!--begin::Timeline heading-->
							<div class="pe-3 mb-1">
								<!--begin::Title-->
								<div class="fs-5 fw-semibold">{{ \Carbon\Carbon::parse($riwayat->created_at)->isoFormat('dddd, D MMMM Y') }}</div>
								<!--end::Title-->
								<!--begin::Description-->
								<div class="d-flex align-items-center mt-1 fs-6">
									<!--begin::Info-->
									<div class="text-muted me-2 fs-7">{{ \Carbon\Carbon::parse($riwayat->created_at)->isoFormat('HH:mm') }} - WIB</div>
									<!--end::Info-->
								</div>
								<!--end::Description-->
							</div>
							<!--end::Timeline heading-->
							<!--begin::Timeline details-->
							<div class="overflow-auto pb-1">
								<!--begin::Notice-->
                                    @php
                                        $isBerbahaya = $riwayat->persentase >= 30;

                                        $bgClass = $isBerbahaya 
                                            ? 'bg-light-danger border-danger badge-danger' 
                                            : 'bg-light-success border-success badge-success';

                                        // ID terakhir
                                        $lastId = $item->riwayatPlagiasi->max('id');
                                        $isTerakhir = $riwayat->id === $lastId;

                                        // jumlah riwayat
                                        $jumlahRiwayat = $item->riwayatPlagiasi->count();

                                        // ambil update_count dari layanan
                                        $updateCount = $item->update_count ?? 1;

                                        // kondisi tambahan
                                        $bolehHapus = $jumlahRiwayat >= $updateCount;
                                    @endphp
                                    <div class="notice d-flex {{ $bgClass }} rounded border border-dashed flex-shrink-0 p-4 mb-2">
                                        <!--begin::Icon-->
                                        <img class="w-40px me-3" src="{{ asset('admin/assets/media/svg/files/pdf.svg') }}">
                                        <!--end::Icon-->
                                        <!--begin::Wrapper-->
                                        <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                                            <!--begin::Content-->
                                            <div class="mb-2 mb-md-0 fw-semibold">
                                                <a href="{{ asset('layanan-cekplagiasi/hasil/' . $riwayat->id) }}">
                                                    <div class="text-gray-900 fw-bold text-hover-primary mt-2" >Download Dokumen Hasil Plagiasi</div>
                                                </a>
                                                <div class="fs-6 text-gray-700 pe-7" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 250px; display: inline-block;">
                                                    {{ basename($riwayat->hasil) }}
                                                </div>
                                            </div>
                                            <!--end::Content-->
                                            <!--begin::Action-->
                                            <div class="badge py-4 px-5 fs-6 {{ $isBerbahaya ? 'badge-danger' : 'badge-success' }} me-2">
                                                {{ $riwayat->persentase }}%
                                            </div>
                                            @can('layanan cekplagiasi-hapus riwayat')
                                                @if($isTerakhir && $bolehHapus)
                                                    <a href="javascript:void(0);" 
                                                        class="badge py-4 px-5 fs-6 badge-warning hover-scale"
                                                        onclick="confirmDelete('{{ route('riwayat.destroy', $riwayat->id) }}')">
                                                        <span class="ki-outline ki-trash text-white fs-5"></span>
                                                    </a>
                                                @endif
                                            @endcan

                                            <!--end::Action-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
								<!--end::Notice-->
							</div>
							<!--end::Timeline details-->
						</div>
						<!--end::Timeline content-->
					</div>
					<!--end::Timeline item-->
                    @endforeach
				</div>
				<!--end::Timeline-->
            </div>
            <div class="text-center mt-12">
                <button type="reset" class="btn btn-light-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
            <!--end:Form-->
        </div>
        <!--end::Modal body-->

            <!--end::Form-->
        </div>
    </div>
</div>
<!--end::Modal - Update user details-->


<script>
function confirmDelete(url) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Riwayat Hasil Cek plagiasi ini akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal',
        customClass: {
            confirmButton: "btn btn-danger",
            cancelButton: "btn btn-secondary"
        }
    }).then(function(result) {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });
}
</script>
