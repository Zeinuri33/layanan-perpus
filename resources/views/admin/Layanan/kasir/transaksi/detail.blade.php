<!--begin::Modal - Update user details-->
<div class="modal fade" id="kt_modal_detail{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-500px">
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
            <div class="modal-body">
                <!--begin:Form-->
                <div class="mb-9 text-center">
                    <!--begin::Title-->
                    <h1 class="mb-3">No.Transaksi: {{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</h1>
                    <div class="text-muted fw-semibold fs-5">Tanggal : {{ Carbon\Carbon::parse($item->created_at)->isoFormat('D MMMM Y') }}</a>.</div>
                    <!--end::Title-->
                </div>
                <!--end::Heading-->
                <div class="card-header border-0 pt-5">
					<h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold text-gray-900">List Pembelian</span>
                        <span class="text-muted mt-1 fw-semibold fs-7">
                            {{ $item->details->count() }} produk
                        </span>
                    </h3>
					<!--begin::Toolbar-->
					<div class="card-toolbar">
						<div class="btn btn-sm btn-light">Kasir: Putra</div>
					</div>
					<!--end::Toolbar-->
				</div>
                <div class="card-body pt-6">
                    @php
                        $colors = ['danger', 'success', 'info', 'primary', 'warning', 'dark'];
                    @endphp
                    @foreach ($item->details as $transaksi)       
                    @php
                        $color = $colors[$loop->index % count($colors)];
                    @endphp                 
					<!--begin::Item-->
					<div class="d-flex flex-stack">
						<!--begin::Symbol-->
						<div class="symbol symbol-40px me-4">
							<div class="symbol-label fs-2 fw-semibold bg-{{ $color }} text-inverse-danger">{{ strtoupper(substr($transaksi->produk->produk, 0, 1)) }}</div>
						</div>
						<!--end::Symbol-->
						<!--begin::Section-->
						<div class="d-flex align-items-center flex-row-fluid flex-wrap">
							<!--begin:Author-->
							<div class="flex-grow-1 me-2">
								<div class="text-gray-800 text-hover-primary fs-6 fw-bold">{{ $transaksi->produk->produk }}</div>
								<span class="text-muted fw-semibold d-block fs-7">{{ $transaksi->qty }} {{ $transaksi->produk->satuan }} x {{ number_format($transaksi->produk->harga, 0, ',', '.') }}</span>
							</div>
							<!--end:Author-->
							<!--begin::Actions-->
							<div class="btn btn-sm btn-bg-light">Rp.{{ number_format($transaksi->subtotal, 0, ',', '.') }}</div>
							<!--begin::Actions-->
						</div>
						<!--end::Section-->
					</div>
					<!--end::Item-->
					<!--begin::Separator-->
                    @if (!$loop->last)
					<div class="separator separator-dashed my-4"></div>
                    @endif
					<!--end::Separator-->
                    @endforeach
                    @php
                        $totalAsli = $item->details ? $item->details->sum(function($d) {
                            return $d->produk->harga * $d->qty;
                        }) : 0;
                    @endphp

                    <!--begin::Summary-->
                    <div class="d-flex flex-stack bg-success rounded-3 p-6 my-11">
                        <!--begin::Label Section-->
                        <div class="fs-6 text-white">
                            <span class="d-block lh-1 mb-2">Total</span>
                            <span class="d-block mb-2">Potongan</span>
                            <span class="d-block mb-2">Donasi</span>
                            <span class="d-block fw-bold mb-2 fs-5">Total</span>
                            <span class="d-block mb-2">Uang Dibayar</span>
                            <span class="d-block mb-2">Kembalian</span>
                        </div>
                        <!--end::Label Section-->
                        <!--begin::Value Section-->
                        <div class="fs-6 text-white text-end">
                            <span class="d-block lh-1 mb-2">Rp{{ number_format($totalAsli, 0, ',', '.') }}</span>
                            <span class="d-block mb-2">-Rp{{ number_format($item->potongan ?? 0, 0, ',', '.') }}</span>
                            <span class="d-block mb-2">Rp{{ number_format($item->donasi ?? 0, 0, ',', '.') }}</span>
                            <span class="d-block fw-bold mb-2 fs-5">Rp{{ number_format($item->total_harga ?? 0, 0, ',', '.') }}</span>
                            <span class="d-block mb-2">Rp{{ number_format($item->uang_dibayar ?? 0, 0, ',', '.') }}</span>
                            <span class="d-block mb-2">Rp{{ number_format($item->uang_kembalian ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <!--end::Value Section-->
                    </div>
                    <!--end::Summary-->
                    <div class="text-center">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Tutup</button>
                        @if(auth()->user()->hasPermissionTo('kasir transaksi-cetak'))
                            <a href="{{ asset('transaksi/cetak/'.$item->id) }}" target="_blank" class="btn btn-warning">Cetak Nota</a>
                        @endif
                    </div>
				</div>
                <!--end:Form-->
            </div>
        </div>
    </div>
</div>
