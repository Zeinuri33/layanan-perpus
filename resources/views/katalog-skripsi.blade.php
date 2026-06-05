<!DOCTYPE html>
<html lang="id">
<head>
    <base href="../../../" />

    <title>Katalog Skripsi - Perpustakaan Ibrahimy</title>

    <meta charset="utf-8" />
    <meta name="description" content="Katalog Skripsi Perpustakaan Ibrahimy" />
    <meta name="keywords" content="Katalog Skripsi Perpustakaan Ibrahimy" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="admin/assets/media/logos/logo perpus icon.png" />
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!-- Global Styles -->
    <link href="admin/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="admin/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

    <style>

        body {
            background-image: url('admin/assets/media/auth/bg6.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        [data-bs-theme="dark"] body {
            background-image: url('admin/assets/media/auth/bg1-dark.jpg');
        }

        .glass {
            background: rgba(255,255,255,0.20);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            box-shadow: 0 4px 30px rgba(0,0,0,0.1);
        }

        .table-scroll {
            max-height: 600px;
            overflow-y: auto;
        }

    </style>

</head>
<body id="kt_body" class="app-blank">
<script>
    var defaultThemeMode = "light";
    var themeMode;
    if (document.documentElement) {
        if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
        } else {
            if (localStorage.getItem("data-bs-theme") !== null) {
                themeMode = localStorage.getItem("data-bs-theme");
            } else {
                themeMode = defaultThemeMode;
            }
        }
        if (themeMode === "system") {

            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";

        }
        document.documentElement.setAttribute("data-bs-theme", themeMode);
    }
</script>

<div class="container-fluid py-5 px-3 px-lg-20">
    <div class="row g-10 min-vh-100 align-items-center">

        <!-- LEFT SIDE -->
        <div class="col-12">
            <div class="h-100 d-flex align-items-center justify-content-center py-10">
                <div class="d-flex flex-column justify-content-center align-items-center text-center">
                    <!-- Logo -->
                    <div class="mb-8">
                        <img
                            class="theme-light-show mw-100 w-125px w-lg-150px"
                            src="admin/assets/media/auth/logo perpus.png"
                            alt=""
                        />

                        <img
                            class="theme-dark-show mw-100 w-125px w-lg-150px"
                            src="admin/assets/media/auth/logo perpus.png"
                            alt=""
                        />
                    </div>

                    <!-- Title -->
                    <h1 class="text-gray-800 fw-bolder fs-1 fs-lg-2hx mb-2">
                        Katalog Skripsi
                    </h1>

                    <!-- Subtitle -->
                    <div class="text-gray-700 fw-semibold fs-4 mb-3">
                        Perpustakaan Ibrahimy
                    </div>

                    <!-- Description -->
                    <div class="text-muted fs-6">Cari skripsi berdasarkan judul,nama mahasiswa, NIM,program studi, dan tahun lulusan.</div>
                </div>
            </div>
        </div>
        <!-- RIGHT -->
        <div class="col-12">

            <div class="glass bg-body rounded-4 w-100 p-5 p-lg-10 d-flex flex-column" 
                style="
                    height: calc(100vh - 40px);
                    max-height: 100vh; 
                "
            >

                <!-- HEADER -->
                <div class="mb-8 flex-shrink-0">
                    <h1 class="text-gray-900 fw-bolder mb-3 fs-2">
                        Pencarian Skripsi
                    </h1>
                    <div class="text-muted fw-semibold fs-6">
                        Sistem Katalog Skripsi Perpustakaan Ibrahimy
                    </div>
                </div>

                <!-- SEARCH -->
                <div class="mb-8 flex-shrink-0 px-2">

                    <!-- SEARCH BAR -->
                    <div class="mb-5">
                        <label class="form-label fw-semibold">
                            Kata Kunci
                        </label>

                        <div class="position-relative">
                            <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5 top-50 translate-middle-y"></i>
                            <input
                                type="text"
                                id="searchInput"
                                class="form-control form-control-lg ps-13"
                                placeholder="Cari judul skripsi, nama mahasiswa, NIM, atau label..."
                                value="{{ request('search') }}"
                            />
                        </div>
                    </div>

                    <!-- FILTER ROW -->
                    <div class="row g-4 align-items-end justify-content-between">

                        <!-- LEFT SIDE -->
                        <div class="col-12 col-lg-8">
                            <div class="row g-4">

                                <!-- Prodi -->
                                <div class="col-12 col-md-7">
                                    <label class="form-label fw-semibold">
                                        Program Studi
                                    </label>

                                    <select
                                        id="filterProdi"
                                        class="form-select"
                                        data-control="select2"
                                        data-placeholder="Semua Prodi"
                                        data-hide-search="false"
                                        data-allow-clear="true"
                                    >
                                        <option></option>

                                        @foreach ($prodi as $item)
                                            <option value="{{ strtolower($item->prodi) }}">
                                                {{ $item->prodi }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Lulusan -->
                                <div class="col-12 col-md-5">
                                    <label class="form-label fw-semibold">
                                        Lulusan
                                    </label>

                                    <select
                                        id="filterLulusan"
                                        class="form-select"
                                        data-control="select2"
                                        data-placeholder="Semua Tahun"
                                        data-hide-search="false"
                                        data-allow-clear="true"
                                    >
                                        <option></option>

                                        @php
                                            $tahunSekarang = date('Y');
                                        @endphp

                                        @for ($tahun = $tahunSekarang; $tahun >= $tahunSekarang - 10; $tahun--)
                                            <option value="{{ $tahun }}">
                                                {{ $tahun }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>

                            </div>
                        </div>

                        <!-- RIGHT SIDE -->
                        <div class="col-12 col-lg-4">

                            <div class="d-flex gap-3 w-100">

                                <button
                                    type="button"
                                    id="btnSearch"
                                    class="btn btn-primary flex-grow-1"
                                >
                                    <i class="ki-outline ki-magnifier fs-2"></i>
                                    Search
                                </button>

                                <button
                                    type="button"
                                    id="btnReset"
                                    class="btn btn-light flex-shrink-0 px-6"
                                >
                                    Reset
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TABLE AREA -->
                <div
                    class="flex-grow-1 overflow-auto rounded"
                    style="min-height: 0;"
                >
                    <div class="table-responsive">
                        <table class="table table-row-dashed align-middle gs-0 gy-4 mb-0">
                            <thead
                                class="position-sticky top-0 bg-success z-index-2"
                            >
                                <tr class="fw-bold text-white">
                                    <th class="ps-5 min-w-100px rounded-start">
                                        Lulusan
                                    </th>
                                    <th class="min-w-180px">
                                        Label
                                    </th>
                                    <th class="min-w-300px">
                                        Judul
                                    </th>
                                    <th class="min-w-220px">
                                        Pengarang
                                    </th>
                                    <th class="text-center pe-5 min-w-150px rounded-end">
                                        Prodi
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                @forelse ($hasil as $item)
                                    @php
                                        $badgeClass = match ($item['fakultas']) {
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
                                            {{ strtolower($item['judul']) }}
                                            {{ strtolower($item['pengarang']) }}
                                            {{ strtolower($item['nim']) }}
                                            {{ strtolower($item['label']) }}
                                        "
                                        data-prodi="{{ strtolower($item['prodi']) }}"
                                        data-lulusan="{{ $item['lulusan'] }}"
                                    >
                                        <!-- Lulusan -->
                                        <td class="ps-5">
                                            <span class="badge badge-light-success px-4 py-3">
                                                {{ $item['lulusan'] }}
                                            </span>
                                        </td>
                                        <!-- Label -->
                                        <td>
                                            <span class="badge badge-light-{{ $badgeClass }} px-4 py-3">
                                                {{ $item['label'] }}
                                            </span>
                                        </td>
                                        <!-- Judul -->
                                        <td>
                                            <div
                                                class="fw-bold text-gray-800"
                                                style="
                                                    display:-webkit-box;
                                                    -webkit-line-clamp:2;
                                                    -webkit-box-orient:vertical;
                                                    overflow:hidden;
                                                "
                                            >
                                                {{ $item['judul'] }}
                                            </div>
                                        </td>
                                        <!-- Pengarang -->
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="fw-bold text-gray-900">
                                                    {{ $item['pengarang'] }}
                                                </span>
                                                <span class="text-muted fs-7">
                                                    {{ $item['nim'] }}
                                                </span>
                                            </div>
                                        </td>
                                        <!-- Prodi -->
                                        <td class="text-center pe-5">
                                            <span class="badge badge-light-{{ $badgeClass }} px-4 py-3">
                                                {{ $item['prodi'] }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                                <!-- EMPTY ROW -->
                                <tr
                                    id="emptyRow"
                                    {{ count($hasil) ? 'style=display:none;' : '' }}
                                >
                                    <td colspan="5" class="text-center py-15">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="ki-outline ki-file-deleted fs-5x text-muted mb-5"></i>
                                            <div class="text-muted fs-3 fw-semibold">
                                                Data skripsi tidak ditemukan
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layout.footer')
</div>

<!-- JS -->
<script src="admin/assets/plugins/global/plugins.bundle.js"></script>
<script src="admin/assets/js/scripts.bundle.js"></script>
<script>

document.addEventListener("DOMContentLoaded", function () {
    const rows = document.querySelectorAll("#tableBody tr");
    const searchInput = document.getElementById('searchInput');
    const filterProdi = document.getElementById('filterProdi');
    const filterLulusan = document.getElementById('filterLulusan');
    const btnSearch = document.getElementById('btnSearch');
    const btnReset = document.getElementById('btnReset');

    // =========================
    // FILTER FUNCTION
    // =========================
    function applyFilter() {

        const search = searchInput.value.toLowerCase().trim();

        const prodiText =
            filterProdi.options[filterProdi.selectedIndex]
            ?.text
            ?.toLowerCase()
            ?.trim();

        const lulusan = filterLulusan.value;

        let visibleCount = 0;

        rows.forEach(row => {

            // skip empty row
            if (row.id === 'emptyRow') return;

            const rowSearch =
                (row.dataset.search || '').toLowerCase();

            const rowProdi =
                (row.dataset.prodi || '').toLowerCase();

            const rowLulusan =
                row.dataset.lulusan || '';

            // SEARCH
            const matchSearch =
                search === '' ||
                rowSearch.includes(search);

            // PRODI
            const matchProdi =
                filterProdi.value === '' ||
                rowProdi.includes(prodiText);

            // LULUSAN
            const matchLulusan =
                lulusan === '' ||
                rowLulusan === lulusan;

            if (
                matchSearch &&
                matchProdi &&
                matchLulusan
            ) {

                row.style.display = '';
                visibleCount++;

            } else {

                row.style.display = 'none';

            }

        });

        // EMPTY STATE
        const emptyRow = document.getElementById('emptyRow');

        if (visibleCount === 0) {

            emptyRow.style.display = '';

        } else {

            emptyRow.style.display = 'none';

        }

    }

    // =========================
    // BUTTON SEARCH
    // =========================
    btnSearch.addEventListener('click', applyFilter);

    // =========================
    // ENTER SEARCH
    // =========================
    searchInput.addEventListener('keyup', function(e) {

        if (e.key === 'Enter') {

            applyFilter();

        }

    });

    // =========================
    // AUTO FILTER SELECT
    // =========================
    filterProdi.addEventListener('change', applyFilter);

    filterLulusan.addEventListener('change', applyFilter);

    // =========================
    // RESET
    // =========================
    btnReset.addEventListener('click', function () {

        searchInput.value = '';

        filterProdi.value = '';
        filterLulusan.value = '';

        $('#filterProdi').trigger('change');
        $('#filterLulusan').trigger('change');

        rows.forEach(row => {

            row.style.display = '';

        });

    });

});

</script>

</body>
</html>