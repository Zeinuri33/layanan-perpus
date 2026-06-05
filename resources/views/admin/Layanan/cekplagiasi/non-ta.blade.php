@extends('layout.sidebarnavbar')
@section('admin-konten')

<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Data Cek Plagiasi Non Tugas Akhir</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="admin/home" class="text-muted text-hover-primary">Beranda</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Cek Plagiasi</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->

            </div>
            <!--end::Toolbar container-->
        </div>

        <!--end::Toolbar-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
			<div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Statistik-->
                <div class="card mb-5 mb-xl-10">
                    <div class="card-body pt-9 pb-0">
                        <!--begin::Details-->
                        <div class="d-flex flex-wrap flex-sm-nowrap">
                            <div class="flex-grow-1">
                                <!--begin::Title-->
                                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                    <!--begin::User-->
                                    <div class="d-flex flex-column">
                                        <!--begin::Name-->
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="text-gray-900 fs-2 fw-bold me-1">Cek Plagiasi Non TA</div>
                                        </div>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Title-->
                                <!--begin::Stats-->
                                <div class="d-flex flex-wrap flex-stack">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column flex-grow-1 pe-8">
                                        <!--begin::Stats-->
                                        <div class="d-flex flex-wrap">
                                            <!--begin::Stat-->
                                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-10">
                                                <!--begin::Label-->
                                                <div class="fw-semibold fs-6 text-gray-500">Jumlah Cek</div>
                                                <!--end::Label-->
                                                <!--begin::Number-->
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-outline ki-teacher fs-3 text-primary me-2"></i>
                                                    <div class="fs-2 fw-bold">{{ $jumlahCek }}</div><span class="fs-2 ms-1">x</span>
                                                </div>
                                                <!--end::Number-->
                                            </div>
                                            <!--end::Stat-->
                                            <!--begin::Stat-->
                                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-10">
                                                <!--begin::Label-->
                                                <div class="fw-semibold fs-6 text-gray-500">Pendapatan</div>
                                                <!--end::Label-->
                                                <!--begin::Number-->
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-outline ki-teacher fs-3 text-primary me-2"></i>
                                                    <div class="fs-2 fw-bold" >Rp. {{ number_format($totalBiaya, 0, ',', '.') }}</div><span class="fs-2 ms-1"></span>
                                                </div>
                                                <!--end::Number-->
                                            </div>
                                            <!--end::Stat-->
                                        </div>
                                        <!--end::Stats-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Details-->
                    </div>
                </div>
                <!--end::Statistik-->
                <!--begin::Card-->
				<div class="card">
					<!--begin::Card header-->
                    <div class="card-header border-0 pt-6">
                        <!--begin::Card title-->
                        <form method="GET" class="mb-3">
                            <div class="d-flex align-items-center gap-2 flex-wrap">

                                {{-- SEARCH --}}
                                <div class="position-relative d-flex align-items-center">
                                    <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4 text-muted"></i>
                                    <input
                                        type="text"
                                        name="search"
                                        value="{{ request('search') }}"
                                        class="form-control w-250px ps-12"
                                        placeholder="Cari NIM atau Nama"
                                    />
                                </div>

                                {{-- TOMBOL FILTER --}}
                                <button type="submit" class="btn btn-primary">
                                    Cari
                                </button>

                                {{-- RESET --}}
                                @if(request('search') || request('angkatan'))
                                    <a href="{{ url()->current() }}" class="btn btn-light">
                                        Reset
                                    </a>
                                @endif

                            </div>
                        </form>


                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            @if(auth()->user()->hasPermissionTo('layanan cekplagiasi-tambah'))
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_tambah_nonta">
                                <i class="ki-outline ki-plus fs-2"></i>Tambah
                            </button>
                            @endif
                            {{-- @endif --}}
                            <!--end::Add product-->
                        </div>
                        <!--end::Card toolbar-->
                        @include('admin.Layanan.cekplagiasi.tambah-nonta')
                    </div>
                    <!--end::Card header-->
					<!--begin::Card body-->
					<div class="card-body py-4">
						<!--begin::Table-->
						<table class="table align-middle table-striped fs-6 gy-5" >
							<thead class="fw-bold fs-5 bg-danger">
								<tr class="text-start text-white fw-bold fs-7 text-uppercase gs-0">
									<th class="rounded-start ps-5 min-800px">Tanggal</th>
									<th class="w-20">Cek Ke</th>
									<th>Nama</th>
									<th class="text-center">Dokumen</th>
									<th class="text-center">Plagiasi</th>
									<th class="text-end rounded-end pe-5">Opsi</th>
								</tr>
							</thead>
							<tbody class="text-gray-600 fw-semibold">
                                @forelse ($plagiasi as $item)
								<tr>
                                    <td class="ps-4">
                                        <div class="badge py-3 px-4 fs-7 badge-light">{{ Carbon\Carbon::parse($item->updated_at)->isoFormat('dddd, D MMMM Y') }}</div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-2">
                                            @if($item->update_count == 1)
                                                <div class="badge py-3 px-4 fs-7 badge-light-primary">Pertama</div>
                                            @else
                                                <div class="badge py-3 px-4 fs-7 badge-light-warning">Ke-{{ $item->update_count }}</div>
                                            @endif
                                            @if($item->riwayatPlagiasi->count() < $item->update_count)
                                                <div class="badge py-3 px-4 fs-7 badge-light-danger">Belum dicek</div>
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ $item->nama }}</td>
                                    <td class="text-center">
                                        @if(auth()->user()->hasPermissionTo('layanan cekplagiasi-file'))
                                        <a href="{{ route('plagiasi.download', $item->id) }}">
                                            <img alt="" class="w-35px hover-scale" src="{{ asset('admin/assets/media/svg/files/doc.svg') }}">
                                        </a>
                                        @endif
                                    </td>
                                    <td class="text-center">

                                        @if(optional($item->riwayatPlagiasi->last())->persentase == null)
                                        <div class="badge py-3 px-4 badge-light-warning fs-7">Belum</div>
                                        @else
                                        @if(optional($item->riwayatPlagiasi->last())->persentase >= 30)
                                        <div class="badge py-3 px-4 badge-light-danger fs-7">{{ optional($item->riwayatPlagiasi->last())->persentase ?? 'Belum ada data' }}%</div>
                                        @elseif(optional($item->riwayatPlagiasi->last())->persentase <= 30)
                                        <div class="badge py-3 px-4 badge-light-success fs-7">{{ optional($item->riwayatPlagiasi->last())->persentase ?? 'Belum ada data' }}%</div>
                                        @endif
                                        @endif
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="#" class="btn btn-sm btn-icon btn-light-danger" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <i class="ki-outline ki-dots-horizontal fs-2"></i></a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-4" data-kt-menu="true">
                                            @if(auth()->user()->hasPermissionTo('layanan cekplagiasi-cetak'))
                                            @if(optional($item->riwayatPlagiasi->last())->persentase <= 30)
                                            @if(optional($item->riwayatPlagiasi->last())->persentase == null)
                                            @else
                                            <div class="menu-item px-3">
                                                <a href="{{ asset('hasilcekplagiasi='.$item->id) }}" class="menu-link px-3" target="_blank">Cetak Ket</a>
                                            </div>
                                            @endif
                                            @endif
                                            @endif
                                            <!--begin::Menu item-->
                                            @if(auth()->user()->hasPermissionTo('layanan cekplagiasi-riwayat'))
                                            <div class="menu-item px-3">
                                                <a class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_detail{{ $item->id }}">Riwayat</a>
                                            </div>
                                            @endif
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            @if(auth()->user()->hasPermissionTo('layanan cekplagiasi-hasil'))
                                            <div class="menu-item px-3">
                                                @php
                                                    $sudahDicek = $item->riwayatPlagiasi->count() > 0 &&
                                                                ($item->update_count == 1 || $item->riwayatPlagiasi->count() == $item->update_count);
                                                @endphp

                                                @if(!$sudahDicek)
                                                    <a href="javascript:void(0);" class="menu-link px-3" onclick="showBelumDicekAlert()" data-bs-toggle="modal" data-bs-target="#kt_modal_hasil{{ $item->id }}">
                                                        Upload Hasil
                                                    </a>
                                                @else
                                                    <a href="javascript:void(0);" class="menu-link px-3 text-muted" onclick="showSudahDicekAlert()">
                                                        Upload Hasil
                                                    </a>
                                                @endif
                                            </div>
                                            @endif
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            @if(auth()->user()->hasPermissionTo('layanan cekplagiasi-edit'))
                                            @if($item->riwayatPlagiasi->count() > 0)
                                            <div class="menu-item px-3">
                                                @php
                                                    $sudahDicek = $item->riwayatPlagiasi->count() >= $item->update_count;
                                                @endphp


                                                @if($sudahDicek)
                                                    <a class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_upload{{ $item->id }}">
                                                        Upload Ulang Doc
                                                    </a>
                                                @else
                                                    <a class="menu-link px-3 text-muted" href="javascript:void(0);" onclick="alertBelumDicek()">
                                                        Upload Ulang Doc
                                                    </a>
                                                @endif
                                            </div>
                                            @endif
                                            <div class="menu-item px-3">
                                                <a href="{{ asset('/admin/layanan-cekplagiasi-'.$item->id.'=edit') }}" class="menu-link px-3">Edit</a>
                                            </div>
                                            @endif
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            @if(auth()->user()->hasPermissionTo('layanan cekplagiasi-hapus'))
                                            <div class="menu-item px-3">
                                                <a href="{{ asset('/admin/layanan-cekplagiasi/'.$item->id.'/hapus') }}" data-url="" class="menu-link px-3 delete-button">Hapus</a>
                                            </div>
                                            @endif
                                            <!--end::Menu item-->
                                        </div>
                                        @include('admin.Layanan.cekplagiasi.detail')
                                        @include('admin.Layanan.cekplagiasi.upload')
                                        @include('admin.Layanan.cekplagiasi.hasil')
                                        <!--end::Menu-->
                                    </td>
								</tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center py-10">
                                        <div class="d-flex flex-column align-items-center text-muted">
                                            <i class="ki-outline ki-file-deleted fs-3x mb-3"></i>
                                            <span class="fw-semibold fs-6">
                                                Data tidak ditemukan
                                            </span>

                                            @if(request('search'))
                                                <span class="fs-7 mt-1">
                                                    Pencarian untuk: <strong>"{{ request('search') }}"</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
							</tbody>
						</table>
                        @if ($plagiasi->hasPages())
                        <div class="d-flex flex-stack flex-wrap py-5 px-4">
                            <div class="fs-6 fw-semibold text-gray-700">
                                Menampilkan
                                {{ $plagiasi->firstItem() }} –
                                {{ $plagiasi->lastItem() }}
                                dari {{ $plagiasi->total() }} data
                            </div>

                            <div>
                                {{ $plagiasi->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                        @endif

						<!--end::Table-->
					</div>
					<!--end::Card body-->
				</div>
				<!--end::Card-->
            </div>
        </div>
    </div>
</div>

@include('layout.footer')


@endsection
