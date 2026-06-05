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
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Katalog Skripsi Lulusan 2025+</h1>
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
                        <li class="breadcrumb-item text-muted">Katalog Skripsi</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Toolbar container-->
        </div>

        <div id="kt_app_content" class="app-content flex-column-fluid">
			<div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Card-->
				<div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">

                        <div class="w-100">

                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-5">

                                <!--begin::Card title-->
                                <div class="d-flex align-items-center gap-3 flex-wrap">

                                    <!-- Search -->
                                    <div class="d-flex align-items-center position-relative my-1">
                                        <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4"></i>

                                        <input
                                            type="text"
                                            id="searchInput"
                                            value="{{ request('search') }}"
                                            class="form-control w-250px ps-12"
                                            placeholder="Cari mahasiswa / NIM / judul"
                                        />
                                    </div>

                                    <!-- Tombol Filter -->
                                    <button
                                        type="button"
                                        class="btn btn-secondary"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#filterSection"
                                    >
                                        <i class="ki-outline ki-filter fs-2"></i>
                                        Filter
                                    </button>

                                    <!-- Tombol Search -->
                                    <button
                                        type="button"
                                        id="btnSearch"
                                        class="btn btn-light-primary"
                                    >
                                        <i class="ki-outline ki-magnifier fs-2"></i>
                                        Search
                                    </button>

                                    <!-- Reset -->
                                    <button
                                        type="button"
                                        id="btnReset"
                                        class="btn btn-light"
                                    >
                                        Reset
                                    </button>

                                </div>
                                <!--end::Card title-->                            
                            </div>

                            <!--begin::Filter Section-->
                            <div
                                class="collapse mt-6 {{ request('prodi') || request('lulusan') ? 'show' : '' }}"
                                id="filterSection"
                            >

                                <div class="card">

                                    <div class="card-body d-flex gap-5 flex-wrap align-items-end">

                                        <!-- Filter Prodi -->
                                        <div class="w-250px">
                                            <label class="form-label fw-semibold">
                                                Program Studi
                                            </label>

                                            <select
                                                id="filterProdi"
                                                class="form-select"
                                                data-control="select2"
                                                data-placeholder="Filter Prodi"
                                            >
                                                <option value="">Semua Prodi</option>

                                                @foreach ($prodi as $item)
                                                    <option
                                                        value="{{ $item->id }}"
                                                        {{ request('prodi') == $item->id ? 'selected' : '' }}
                                                    >
                                                        {{ $item->prodi }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Filter Lulusan -->
                                        <div class="w-200px">
                                            <label class="form-label fw-semibold">
                                                Tahun Lulusan
                                            </label>

                                            <select
                                                id="filterLulusan"
                                                class="form-select"
                                                data-control="select2"
                                                data-placeholder="Filter Tahun"
                                            >
                                                <option value="">Semua Tahun</option>

                                                @php
                                                    $tahunSekarang = date('Y');
                                                @endphp

                                                @for ($tahun = $tahunSekarang; $tahun >= $tahunSekarang - 10; $tahun--)
                                                    <option
                                                        value="{{ $tahun }}"
                                                        {{ request('lulusan') == $tahun ? 'selected' : '' }}
                                                    >
                                                        {{ $tahun }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>

                                        <!-- Tombol Terapkan -->
                                        <div>
                                            <button
                                                type="button"
                                                id="btnFilter"
                                                class="btn btn-primary"
                                            >
                                                <i class="ki-outline ki-filter fs-2"></i>
                                                Terapkan
                                            </button>
                                        </div>

                                    </div>

                                </div>

                            </div>
                            <!--end::Filter Section-->

                        </div>

                    </div>
                    <!--end::Card header-->

					<!--begin::Card body-->
					<div class="card-body py-4">
						<!--begin::Table-->
                        <table class="table align-middle table-striped fs-6 gy-5" id="kt_ecommerce_products_table">
                            <thead class="fw-bold fs-5 bg-success">
                                <tr class="text-start text-white fw-bold fs-7 text-uppercase gs-0">
                                    <th class="rounded-start ps-5 min-w-200px">Lulusan</th>
                                    <th class="min-w-100px text-center">Label</th>
                                    <th class="min-w-250px">Judul TA</th>
                                    <th class="min-w-150px">Pengarang</th>
                                    <th class="text-center min-w-150px">Prodi</th>
                                    <th class="text-end rounded-end pe-5 min-w-150px">Plagiasi%</th>
                                </tr>
                            </thead>

                            <tbody class="text-gray-600 fw-semibold">

                                @forelse ($plagiasi as $item)
                                @php
                                    $fakultas = $item->mahasiswa?->programstudi?->fakultas;
                                    $badgeClass = match ($fakultas) {
                                        'Syariah dan Ekonomi Islam' => 'success',
                                        'Tarbiyah' => 'warning',
                                        'Sains dan Teknologi' => 'primary',
                                        'Sosial dan Humaniora' => 'danger',
                                        'Dakwah' => 'info',
                                        'Ilmu Kesehatan' => 'secondary',
                                        default => 'dark',
                                    };
                                @endphp
                                    <tr
                                        data-search="
                                            {{ strtolower($item->mahasiswa?->nama) }}
                                            {{ strtolower($item->mahasiswa?->nim) }}
                                            {{ strtolower($item->judul) }}
                                        "
                                        data-prodi="{{ strtolower($item->mahasiswa?->programstudi->kode) }}"
                                        data-lulusan="{{ $item->mahasiswa?->angkatan+4 }}"
                                    >

                                        {{-- Lulusan --}}
                                        <td class="ps-5">
                                            <span class="badge py-3 px-4 badge-light-success fs-7">
                                                {{ $item->mahasiswa?->angkatan + 4 }}
                                            </span>
                                        </td>

                                        {{-- Label --}}
                                        <td class="text-center">
                                            <span class="badge py-3 px-4 badge-light-{{ $badgeClass }} fs-7">
                                                {{ 
                                                    $item->mahasiswa?->programstudi?->kode . '.' .
                                                    substr(($item->mahasiswa?->angkatan + 4), -2) . '.' .
                                                    substr($item->mahasiswa?->nim, -3)
                                                }}
                                            </span>
                                        </td>

                                        {{-- Judul --}}
                                        <td style="max-width: 300px;">
                                            <div
                                                class=""
                                                style="
                                                    display: -webkit-box;
                                                    -webkit-line-clamp: 2;
                                                    -webkit-box-orient: vertical;
                                                    overflow: hidden;
                                                    text-overflow: ellipsis;
                                                    word-break: break-word;
                                                    line-height: 1.5em;
                                                    max-height: 3em;
                                                "
                                            >
                                                {{ $item->judul }}
                                            </div>
                                        </td>

                                        {{-- Pengarang --}}
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="d-flex justify-content-start flex-column">
                                                    <div class="text-gray-900 fw-bold mb-1 fs-6">{{ $item->mahasiswa?->nama }}</div>
                                                    <span class="text-muted fw-semibold text-muted d-block fs-7">{{ $item->mahasiswa?->nim }}</span>
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Prodi --}}
                                        <td class="text-center">
                                            <div class="badge py-3 px-4 badge-light-{{ $badgeClass }} fs-7">
                                                {{ $item->mahasiswa?->programstudi->kode }}
                                            </div>
                                        </td>
                                        <td class="text-end pe-5">
                                            @if(optional($item->riwayatPlagiasi->last())->persentase == null)
                                            <div class="badge py-3 px-4 badge-warning fs-7">Belum</div>
                                            @else
                                            @if(optional($item->riwayatPlagiasi->last())->persentase >= 31)
                                            <div class="badge py-3 px-4 badge-danger fs-7">{{ optional($item->riwayatPlagiasi->last())->persentase ?? 'Belum ada data' }}%</div>
                                            @elseif(optional($item->riwayatPlagiasi->last())->persentase <= 31)
                                            <div class="badge py-3 px-4 badge-success fs-7">{{ optional($item->riwayatPlagiasi->last())->persentase ?? 'Belum ada data' }}%</div>
                                            @endif
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-10">
                                            Belum ada data skripsi.
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table>
                        <!--end::Table-->

                        {{-- Pagination --}}
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
					<!--end::Card body-->
				</div>
				<!--end::Card-->
            </div>
        </div>
    </div>
</div>

<script src="admin/assets/plugins/global/plugins.bundle.js"></script>
<script src="admin/assets/js/scripts.bundle.js"></script>


<script>
document.addEventListener("DOMContentLoaded", function () {

    const searchInput = document.getElementById('searchInput');

    const filterProdi = document.getElementById('filterProdi');
    const filterLulusan = document.getElementById('filterLulusan');

    const btnSearch = document.getElementById('btnSearch');
    const btnFilter = document.getElementById('btnFilter');
    const btnReset = document.getElementById('btnReset');

    // =========================
    // FUNCTION APPLY FILTER
    // =========================
    function applyFilter() {

        const url = new URL(window.location.href);

        const search = searchInput.value.trim();
        const prodi = filterProdi.value;
        const lulusan = filterLulusan.value;

        // SEARCH
        if (search !== '') {
            url.searchParams.set('search', search);
        } else {
            url.searchParams.delete('search');
        }

        // PRODI
        if (prodi !== '') {
            url.searchParams.set('prodi', prodi);
        } else {
            url.searchParams.delete('prodi');
        }

        // LULUSAN
        if (lulusan !== '') {
            url.searchParams.set('lulusan', lulusan);
        } else {
            url.searchParams.delete('lulusan');
        }

        // RESET PAGE
        url.searchParams.delete('page');

        // REDIRECT
        window.location.href = url.toString();
    }

    // =========================
    // SEARCH BUTTON
    // =========================
    btnSearch.addEventListener('click', applyFilter);

    // =========================
    // FILTER BUTTON
    // =========================
    btnFilter.addEventListener('click', applyFilter);

    // =========================
    // ENTER SEARCH
    // =========================
    searchInput.addEventListener('keydown', function(e) {

        if (e.key === 'Enter') {

            e.preventDefault();

            applyFilter();
        }

    });

    // =========================
    // RESET
    // =========================
    btnReset.addEventListener('click', function () {

        window.location.href = window.location.pathname;

    });

});
</script>


@include('layout.footer')

@endsection
