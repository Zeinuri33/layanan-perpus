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
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Data Cek Plagiasi Tugas Akhir</h1>
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
        <!--begin::Content-->
		<div id="kt_app_content" class="app-content flex-column-fluid">
			<!--begin::Content container-->
			<div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Row-->
                <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">

                    <!--begin::Col-->
                    <div class="col-xl-3 d-flex">
                        <div class="card card-flush w-100 d-flex flex-column bgi-no-repeat bgi-size-contain bgi-position-x-end"
                            style="background-color: #00a884;background-image:url('admin/assets/media/santri/pattern.png')">

                            <div class="card-header pt-5">
                                <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                    style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #00a884">
                                    <i class="ki-outline ki-teacher text-white fs-2qx lh-0"></i>
                                </div>
                            </div>

                            <div class="card-body d-flex align-items-end mb-3 flex-grow-1">
                                <div class="d-flex align-items-center">
                                    <span class="fs-4hx text-white fw-bold me-6">
                                        {{ $jumlahMahasiswaAngkatan }}
                                    </span>
                                    <div class="fw-bold fs-6 text-white">
                                        <span class="d-block">Mahasiswa</span>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer mt-auto"
                                style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                                <div class="fw-bold text-white py-1 fs-5">
                                    <span>
                                        Tingkat Plagiasi Mahasiswa Calon Lulusan {{ $angkatan + 4 }};
                                        {{ $totalRataPlagiasi ?? 0 }}%
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-xl-3 d-flex">
                        <div class="card card-flush w-100 d-flex flex-column bgi-no-repeat bgi-size-contain bgi-position-x-end"
                            style="background-color: #7239EA;background-image:url('admin/assets/media/santri/pattern.png')">

                            <div class="card-header pt-5">
                                <div class="d-flex flex-center rounded-circle h-80px w-80px"
                                    style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #7239EA">
                                    <i class="ki-outline ki-abstract-26 text-white fs-2qx lh-0"></i>
                                </div>
                            </div>

                            <div class="card-body d-flex align-items-end mb-3 flex-grow-1">
                                <div class="d-flex align-items-center">
                                    <span class="fs-4hx text-white fw-bold me-6">{{ $jumlahTotal }}</span>
                                    <div class="fw-bold fs-6 text-white">
                                        <span class="d-block">Mahasiswa cek</span>
                                        <span>plagiasi lebih dari 1 kali</span>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer mt-auto"
                                style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                                <div class="fw-bold text-white py-1 fs-5">
                                    <span>Total pendapatan</span><br>
                                    <span>Rp. {{ number_format($totalPendapatan, 0, ',', '.') }}</span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-xl-6 d-flex">
                        <div class="card w-100 d-flex flex-column"
                            style="background: linear-gradient(112.14deg, #FF8A00 0%, #E96922 100%)">

                            <div class="card-body flex-grow-1">
                                <div class="row align-items-center h-100">

                                    <div class="col-sm-7 pe-0 mb-5 mb-sm-0 d-flex flex-column justify-content-between">
                                        <div class="pt-xl-5 pb-xl-2 ps-xl-7">

                                            <div class="mb-7">
                                                <div class="mb-6">
                                                    <h3 class="fs-2x fw-semibold text-white">Rekapitulasi</h3>
                                                    <span class="fw-semibold text-white opacity-75">
                                                        Mahasiswa yang cek plagiasi lebih dari 1 kali
                                                    </span>
                                                </div>

                                                <div class="d-flex flex-wrap mb-2">
                                                    <div class="rounded min-w-100px py-3 px-4 my-1 me-2"
                                                        style="border: 1px dashed rgba(255, 255, 255, 0.2)">
                                                        <div class="text-white fs-4 fw-bold">
                                                            <span data-kt-countup="true"
                                                                data-kt-countup-value="{{ $jumlahPutra }}">0</span> Mhs
                                                        </div>
                                                        <div class="fw-semibold fs-8 text-white opacity-90">Putra</div>
                                                    </div>

                                                    <div class="rounded min-w-100px py-3 px-4 my-1"
                                                        style="border: 1px dashed rgba(255, 255, 255, 0.2)">
                                                        <div class="text-white fs-4 fw-bold">
                                                            Rp.<span data-kt-countup="true"
                                                                data-kt-countup-value="{{ $putra }}">0</span>
                                                        </div>
                                                        <div class="fw-semibold fs-8 text-white opacity-90">Total Pendapatan</div>
                                                    </div>
                                                </div>

                                                <div class="d-flex flex-wrap">
                                                    <div class="rounded min-w-100px py-3 px-4 my-1 me-2"
                                                        style="border: 1px dashed rgba(255, 255, 255, 0.2)">
                                                        <div class="text-white fs-4 fw-bold">
                                                            <span data-kt-countup="true"
                                                                data-kt-countup-value="{{ $jumlahPutri }}">0</span> Mhs
                                                        </div>
                                                        <div class="fw-semibold fs-8 text-white opacity-90">Putri</div>
                                                    </div>

                                                    <div class="rounded min-w-100px py-3 px-4 my-1"
                                                        style="border: 1px dashed rgba(255, 255, 255, 0.2)">
                                                        <div class="text-white fs-6 fw-bold">
                                                            Rp.<span data-kt-countup="true"
                                                                data-kt-countup-value="{{ $putri }}">0</span>
                                                        </div>
                                                        <div class="fw-semibold fs-8 text-white opacity-90">Total Pendapatan</div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-sm-5">
                                        <!--begin::Illustration-->
                                        <img src="{{ asset('admin/assets/media/santri/menara.png') }}"  class="position-absolute bottom-0 end-0 h-250px" alt="" />
                                        <!--end::Illustration-->
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <!--end::Col-->

                </div>
                <!--end::Row-->
                <!--begin::Card-->
				<div class="card">
					<!--begin::Card header-->
                    <div class="card-header border-0 pt-6 d-flex justify-content-between align-items-center flex-wrap gap-3">

                        <!-- KIRI -->
                        <div class="d-flex align-items-center flex-wrap gap-2">
                            <form method="GET">
                                <div class="d-flex align-items-center flex-wrap gap-2">

                                    {{-- SEARCH --}}
                                    <div class="position-relative d-flex align-items-center">
                                        <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4 text-muted"></i>
                                        <input
                                            type="text"
                                            name="search"
                                            value="{{ request('search') }}"
                                            class="form-control w-200px ps-12"
                                            placeholder="Cari NIM atau Nama"
                                        />
                                    </div>

                                    {{-- FILTER ANGKATAN --}}
                                    <div class="w-150px">
                                        <select
                                            name="angkatan"
                                            class="form-select"
                                            data-control="select2"
                                            data-hide-search="true"
                                            data-placeholder="Angkatan"
                                        >
                                            <option></option>

                                            {{-- <option value="all"
                                                {{ request('angkatan', $defaultAngkatan) == 'all' ? 'selected' : '' }}>
                                                Semua
                                            </option> --}}

                                            @for($i = now()->year; $i >= now()->year - 7; $i--)
                                                <option value="{{ $i }}"
                                                    {{ request('angkatan', $defaultAngkatan) == $i ? 'selected' : '' }}>
                                                    {{ $i + 4 }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    {{-- BUTTON --}}
                                    <button type="submit" class="btn btn-primary">Cari</button>

                                    @if(request('search') || request('angkatan'))
                                        <a href="{{ url()->current() }}" class="btn btn-light">Reset</a>
                                    @endif

                                </div>
                            </form>
                        </div>

                        <!-- KANAN -->
                        <div class="card-toolbar d-flex align-items-center gap-2 flex-wrap">

                            @if(auth()->user()->hasPermissionTo('layanan cekplagiasi-rekap'))
                            <a href="{{ url('/admin/layanan-cekplagiasi=rekap') }}?angkatan={{ request('angkatan') ?? $defaultAngkatan }}&search={{ request('search') }}"
                                class="btn btn-light-success">
                                <i class="ki-outline ki-file-up fs-2"></i>Rekap
                            </a>
                            @endif

                            @if(auth()->user()->hasPermissionTo('layanan cekplagiasi-tambah'))
                            <a href="/admin/layanan-cekplagiasi=tambah" class="btn btn-danger">
                                <i class="ki-outline ki-plus fs-2"></i>Tambah
                            </a>
                            @endif

                        </div>

                    </div>

					<!--begin::Card body-->
					<div class="card-body py-4">
                    <div style="overflow-x: auto;">
						<!--begin::Table-->
						<table class="table align-middle table-striped fs-6 gy-5" >
							<thead class="fw-bold fs-5 bg-danger">
								<tr class="text-start text-white fw-bold fs-7 text-uppercase gs-0">
									<th class="rounded-start ps-5 min-800px">Tanggal</th>
									<th class="w-20">Cek Ke</th>
									<th class="text-center">NIM</th>
									<th>Nama</th>
									<th>Prodi</th>
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
                                    <td class="text-center">{{ $item->mahasiswa->nim }}</td>
                                    <td>{{ $item->mahasiswa->nama }}</td>
                                    <td>{{ $item->mahasiswa->prodi }}</td>
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
                                        @if(optional($item->riwayatPlagiasi->last())->persentase >= 31)
                                        <div class="badge py-3 px-4 badge-light-danger fs-7">{{ optional($item->riwayatPlagiasi->last())->persentase ?? 'Belum ada data' }}%</div>
                                        @elseif(optional($item->riwayatPlagiasi->last())->persentase <= 31)
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
                                                <a href="{{ asset('hasilcekplagiasi='.$item->id) }}" class="menu-link px-3" target="_blank">Cetak SKHCP</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="{{ asset('pernyataanpublikasi='.$item->id) }}" class="menu-link px-3" target="_blank">Cetak LKP</a>
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
                    </div>
						<!--end::Table-->
					</div>
					<!--end::Card body-->
				</div>
				<!--end::Card-->
            </div>
        </div>
    </div>
</div>

<!--begin::Javascript-->
<script>var hostUrl = "assets/";</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="admin/assets/plugins/global/plugins.bundle.js"></script>
<script src="admin/assets/js/scripts.bundle.js"></script>
<!--end::Globadmin/al Javascript Bundle-->
<!--begin::Veadmin/ndors Javascript(used for this page only)-->
<script src="admin/assets/plugins/custom/datatables/datatables.bundle.js"></script>
<!--end::Vendadmin/ors Javascript-->
<!--begin::Cuadmin/stom Javascript(used for this page only)-->
<script src="admin/assets/js/custom/apps/ecommerce/catalog/products.js"></script>
<script src="admin/assets/js/widgets.bundle.js"></script>
<script src="admin/assets/js/custom/widgets.js"></script>
<!--end::Custom Javascript-->
@if (session('success'))
<script>
    Swal.fire({
    title: 'Alhamdulillah!',
    text: '{{ session('berhasil') }}',
    icon: 'success',
    showConfirmButton: false,
    timer: 1500,
    timerProgressBar: true,
});
</script>
@endif

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

<!--end::Javascript-->
<!--begin::Footer-->
@include('layout.footer')
<!--end::Footer-->

@endsection
