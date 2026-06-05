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
                                            <div class="text-gray-900 fs-2 fw-bold me-1">Cek Plagiasi Non Tugas Akhir</div>  
                                        </div>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Title-->
                                <!--begin::Stats-->
                                <div class="row g-5 mb-8">

                                    <!-- ================= BARIS 1 ================= -->
                                    <!-- Jumlah Cek -->
                                    <div class="col-xl-2 col-md-6">
                                        <div class="border border-gray-300 border-dashed rounded p-4 h-100">
                                            <div class="fw-semibold fs-6 text-gray-500 mb-2">Jumlah Cek</div>
                                            <div class="d-flex align-items-center">
                                                <i class="ki-outline ki-teacher fs-3 text-primary me-2"></i>
                                                <div class="fs-2 fw-bold">
                                                    {{ number_format($jumlahCek ?? 0) }}
                                                </div>
                                                <span class="fs-2 ms-1">x</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Total Pendapatan -->
                                    <div class="col-xl-2 col-md-6">
                                        <div class="border border-gray-300 border-dashed rounded p-4 h-100">
                                            <div class="fw-semibold fs-6 text-gray-500 mb-2">Total Pendapatan</div>
                                            <div class="d-flex align-items-center">
                                                <i class="ki-outline ki-dollar fs-3 text-success me-2"></i>
                                                <div class="fs-2 fw-bold">
                                                    Rp. {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pendapatan per Petugas -->
                                    @foreach(['Putra','Putri','FIK','FSEI'] as $p)
                                    <div class="col-xl-2 col-md-6">
                                        <div class="border border-gray-300 border-dashed rounded p-4 h-100">
                                            <div class="fw-semibold fs-6 text-gray-500 mb-2">{{ $p }}</div>
                                            <div class="d-flex align-items-center">
                                                <i class="ki-outline ki-chart fs-3 text-info me-2"></i>
                                                <div class="fs-2 fw-bold">
                                                    Rp. {{ number_format($pendapatanPerPetugas[$p] ?? 0, 0, ',', '.') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach


                                    <!-- ================= BARIS 2 ================= -->
                                    @foreach(['Putra','Putri','FIK','FSEI'] as $p)
                                    <div class="col-xl-3 col-md-6">
                                        <div class="border border-gray-300 border-dashed rounded p-4 h-100">
                                            <div class="fw-semibold fs-6 text-gray-500 mb-2">
                                                {{ $p }} (Bulan Ini)
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <i class="ki-outline ki-calendar fs-3 text-warning me-2"></i>
                                                <div class="fs-2 fw-bold">
                                                    Rp. {{ number_format($pendapatanPerPetugasBulanan[$p] ?? 0, 0, ',', '.') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
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
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>
                                <input type="text" data-kt-ecommerce-product-filter="search" class="form-control w-250px ps-12" placeholder="Cari Mahasiswa"/>
                            </div>
                            <!--end::Search-->
                        </div>
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
                        @include('admin.Layanan.cekplagiasi.nonta.tambah')
                    </div>
                    <!--end::Card header-->
					<!--begin::Card body-->
					<div class="card-body py-4">
						<!--begin::Table-->
						<table class="table align-middle table-striped fs-6 gy-5" id="kt_ecommerce_products_table">
							<thead class="fw-bold fs-5 bg-danger">
								<tr class="text-start text-white fw-bold fs-7 text-uppercase gs-0">
									<th class="rounded-start ps-5 min-800px">Tanggal</th>
									<th class="w-20">Cek Ke</th>
									<th>Nama</th>
									<th class="text-center">Dokumen</th>
									<th></th>
									<th class="text-center">Hasil</th>
									<th class="text-center">Plagiasi</th>
									<th class="text-end rounded-end pe-5">Opsi</th>
								</tr>
							</thead>
							<tbody class="text-gray-600 fw-semibold">
                                @forelse ($nonta as $item)
								<tr>
                                    <td class="ps-4">
                                        <div class="badge py-3 px-4 fs-7 badge-light">
                                            {{ \Carbon\Carbon::parse($item->updated_at)->isoFormat('dddd, D MMMM Y') }}
                                        </div>
                                    </td>
                                    <td>
                                        @if($item->update_count == 1)
                                            <div class="my-1 badge py-3 px-4 fs-7 badge-light-primary">Pertama</div>
                                        @else
                                            <div class="my-1 badge py-3 px-4 fs-7 badge-light-warning">Ke-{{ $item->update_count }}</div>
                                        @endif
                                        @if ($item->hasil == null)
                                            <div class="my-1 badge py-3 px-4 fs-7 badge-light-danger">Belum</div>
                                        @endif
                                    </td>
                                    <td>{{ $item->nama }}</td>
                                    <td class="text-center">
                                        @if(auth()->user()->hasPermissionTo('layanan cekplagiasi-file'))
                                        <a href="{{ route('nonta.download', $item->id) }}">
                                            <img class="w-35px hover-scale" src="{{ asset('admin/assets/media/svg/files/doc.svg') }}">
                                        </a>
                                        @endif
                                    </td>
                                    <td></td>
                                    <td class="text-center">
                                        @if ($item->hasil)
                                            <a href="{{ asset('storage/' . $item->hasil) }}" target="_blank">
                                                <img class="w-35px hover-scale" src="{{ asset('admin/assets/media/svg/files/pdf.svg') }}">
                                            </a>
                                        @else
                                            <div class="badge py-3 px-4 fs-7 badge-danger">Belum dicek</div>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if(!$item->persentase)
                                            <div class="badge py-3 px-4 badge-light-warning fs-7">Belum</div>
                                        @elseif($item->persentase >= 31)
                                            <div class="badge py-3 px-4 badge-light-danger fs-7">{{ $item->persentase }}%</div>
                                        @else
                                            <div class="badge py-3 px-4 badge-light-success fs-7">{{ $item->persentase }}%</div>
                                        @endif
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="#" class="btn btn-sm btn-icon btn-light-danger" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <i class="ki-outline ki-dots-horizontal fs-2"></i></a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-4" data-kt-menu="true">
                                            @if(auth()->user()->hasPermissionTo('layanan cekplagiasi-cetak'))
                                            @if($item->persentase <= 30)
                                            @if($item->persentase == null)
                                            @else
                                            <div class="menu-item px-3">
                                                <a href="{{ asset('hasilplagiasi='.$item->id) }}" class="menu-link px-3" target="_blank">Cetak Ket</a>
                                            </div>
                                            @endif
                                            @endif
                                            @endif                                            
                                            <!--begin::Menu item-->
                                            @if(auth()->user()->hasPermissionTo('layanan cekplagiasi-hasil'))
                                            <div class="menu-item px-3">
                                                @if($item->hasil == null)
                                                    <a href="javascript:void(0);" class="menu-link px-3" onclick="showBelumDicekAlert()" data-bs-toggle="modal" data-bs-target="#kt_modal_uploadhasil{{ $item->id }}">
                                                        Upload Hasil
                                                    </a>
                                                @endif
                                            </div>
                                            @endif
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            @if(auth()->user()->hasPermissionTo('layanan cekplagiasi-edit'))
                                            @if($item->hasil)
                                            <div class="menu-item px-3">
                                                @php
                                                    $sudahDicek = $item->hasil;
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
                                                <a data-bs-toggle="modal" data-bs-target="#kt_modal_edit_nonta{{ $item->id }}" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            @endif
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            @if(auth()->user()->hasPermissionTo('layanan cekplagiasi-hapus'))
                                            <div class="menu-item px-3">
                                                <a href="{{ asset('/admin/layanan-plagiasi/'.$item->id.'/hapus') }}" data-url="" class="menu-link px-3 delete-button">Hapus</a>
                                            </div>
                                            @endif
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                        @include('admin.Layanan.cekplagiasi.nonta.edit')
                                        @include('admin.Layanan.cekplagiasi.nonta.uploadhasil')
                                        @include('admin.Layanan.cekplagiasi.nonta.uploadulang')
                                    </td>
								</tr>
                                @endforeach
							</tbody>
						</table>
						<!--end::Table-->
					</div>
					<!--end::Card body-->
				</div>
				<!--end::Card-->
            </div>
        </div>
    </div>
</div>

<script>var hostUrl = "assets/";</script>
<script src="admin/assets/plugins/global/plugins.bundle.js"></script>
<script src="admin/assets/js/scripts.bundle.js"></script>
<script src="admin/assets/plugins/custom/datatables/datatables.bundle.js"></script>
<script src="admin/assets/js/custom/apps/ecommerce/catalog/products.js"></script>



<script>
    function alertBelumDicek() {
        Swal.fire({
            icon: 'warning',
            title: 'Astaghfirullah!',
            text: 'File sebelumnya masih belum dicek. Silakan tunggu hingga proses pengecekan selesai sebelum mengunggah ulang.',
            confirmButtonText: 'OK',
            customClass: {
                confirmButton: 'btn btn-danger'
            },
            buttonsStyling: false
        });
    }
</script>
<script>
    function showSudahDicekAlert() {
        Swal.fire({
            title: 'Astaghfirullah!',
            text: 'File sudah selesai dicek. Anda tidak bisa mengunggah hasil lagi.',
            icon: 'info',
            confirmButtonText: 'OK',
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-primary'
            }
        });
    }
</script>

@include('layout.footer')


@endsection