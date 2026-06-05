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
                    <h1 class="page-heading fw-bold fs-3 my-0">
                        Data Pembuatan Kartu Anggota
                        @if(request('jk') === 'Putra')
                            - Putra
                        @elseif(request('jk') === 'Putri')
                            - Putri
                        @endif
                    </h1>

                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item">
                            <a href="/admin/home" class="text-muted">Beranda</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ url('/admin/layanan-kartu') }}" class="text-muted">Kartu Anggota</a>
                        </li>

                        @if(request('jk'))
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            {{ request('jk') }}
                        </li>
                        @endif
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
            </div>

        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
				<div class="card mb-5 mb-xl-10">
                    @if(!request()->has('jk'))
                    {{-- =======================
                        STATISTIK GLOBAL
                    ======================= --}}
                    <div class="card-body py-10">
                        <h2 class="mb-4">
                            Statistik Layanan Kartu Anggota Bulan
                            {{ \Carbon\Carbon::createFromDate($tahun, $bulan)->isoFormat('MMMM Y') }}
                        </h2>

                        <div class="row">
                            <!-- Anggota Baru -->
                            <div class="col">
                                <div class="card card-dashed flex-center min-w-175px my-3 p-6">
                                    <span class="fs-4 fw-semibold text-success">Anggota Baru</span>
                                    <span class="fs-1 fw-bold"
                                        data-kt-countup="true"
                                        data-kt-countup-value="{{ $jumlahAnggotaBaru }}">0</span>
                                </div>
                            </div>

                            <!-- Cetak Ulang -->
                            <div class="col">
                                <div class="card card-dashed flex-center min-w-175px my-3 p-6">
                                    <span class="fs-4 fw-semibold text-danger">Cetak Ulang</span>
                                    <span class="fs-1 fw-bold"
                                        data-kt-countup="true"
                                        data-kt-countup-value="{{ $jumlahCetakUlang }}">0</span>
                                </div>
                            </div>

                            <!-- Mahasiswa Baru -->
                            <div class="col">
                                <div class="card card-dashed flex-center min-w-175px my-3 p-6">
                                    <span class="fs-4 fw-semibold text-primary">Mahasiswa Baru</span>
                                    <span class="fs-1 fw-bold"
                                        data-kt-countup="true"
                                        data-kt-countup-value="{{ $jumlahMahasiswaBaru }}">0</span>
                                </div>
                            </div>

                            <!-- Kartu Tercetak -->
                            <div class="col">
                                <div class="card card-dashed flex-center min-w-175px my-3 p-6">
                                    <span class="fs-4 fw-semibold text-info">Kartu Tercetak</span>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <span class="fs-1 fw-bold"
                                            data-kt-countup="true"
                                            data-kt-countup-value="{{ $jumlahSelesai }}">0</span>
                                        <span class="fs-1 fw-bold ms-2">Kartu</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Pendapatan -->
                            <div class="col">
                                <div class="card card-dashed flex-center min-w-175px my-3 p-6">
                                    <span class="fs-4 fw-semibold text-warning">Pendapatan</span>
                                    <div class="d-flex align-items-center justify-content-center text-nowrap">
                                        <span class="fs-1 fw-bold">Rp.</span>
                                        <span class="fs-1 fw-bold ms-2"
                                            data-kt-countup="true"
                                            data-kt-countup-value="{{ $pendapatan }}">0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @else
                    {{-- =======================
                        STATISTIK PER JK
                    ======================= --}}
                    @php
                        $jk = request('jk'); // Putra / Putri
                    @endphp

                    <div class="card-body d-flex align-items-center pt-1 pb-0">
                        <div class="d-flex flex-column flex-grow-1 py-2 py-lg-13 me-2">
                            <div class="text-gray-900 fw-bold fs-2 mb-4">
                                Layanan Kartu Perpustakaan {{ $jk }} Bulan {{ \Carbon\Carbon::createFromDate($tahun, $bulan)->isoFormat('MMMM Y') }}
                            </div>
                            <div class="d-flex flex-wrap m2">
                                <div class="my-2 border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6">
                                    <div class="fw-semibold fs-6 text-gray-600">Anggota Baru</div>
                                    <div class="d-flex align-items-center">
                                        <i class="ki-outline ki-simcard fs-3 text-success me-2"></i>
                                        <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="{{ $jumlahAnggotaBaru }}">0</div>
                                    </div>
                                </div>
                                <div class="my-2 border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6">
                                    <div class="fw-semibold fs-6 text-gray-600">Cetak Ulang</div>
                                    <div class="d-flex align-items-center">
                                        <i class="ki-outline ki-simcard fs-3 text-danger me-2"></i>
                                        <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="{{ $jumlahCetakUlang }}">0</div>
                                    </div>
                                </div>
                                <div class="my-2 border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6">
                                    <div class="fw-semibold fs-6 text-gray-600">Mahasiswa Baru</div>
                                    <div class="d-flex align-items-center">
                                        <i class="ki-outline ki-teacher fs-3 text-primary me-2"></i>
                                        <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="{{ $jumlahMahasiswaBaru }}">0</div>
                                    </div>
                                </div>
                                <div class="my-2 border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6">
                                    <div class="fw-semibold fs-6 text-gray-600">Kartu Tercetak</div>
                                    <div class="d-flex align-items-center">
                                        <i class="ki-outline ki-check-circle fs-3 text-info me-2"></i>
                                        <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="{{ $jumlahSelesai }}">0</div>
                                        <span class="fs-2 fw-bold ms-2">Kartu</span>
                                    </div>
                                </div>
                                <div class="my-2 border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6">
                                    <div class="fw-semibold fs-6 text-gray-600">Pendapatan</div>
                                    <div class="d-flex align-items-center">
                                        <i class="ki-outline ki-tag fs-3 text-warning me-2"></i>
                                        <div class="fs-2 fw-bold ms-2">Rp.</div>
                                        <span class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="{{ $pendapatan }}">0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <img src="admin/assets/media/santri/santri{{ $jk === 'Putra' ? 'pa' : 'pi' }}.png" alt="" class="align-self-end h-150px">
                    </div>
                    @endif
                </div>

                <div class="card">
                    <div class="card-header border-0 pt-6 d-flex justify-content-between align-items-center flex-wrap gap-3">

                        <form method="GET" id="filterForm" class="d-flex align-items-center gap-3 flex-wrap w-100">

                            {{--  PERTAHANKAN SEMUA FILTER --}}
                            <input type="hidden" name="jk" value="{{ request('jk') }}">
                            <input type="hidden" name="ket" value="{{ request('ket') }}">

                            {{--  SEARCH --}}
                            <div class="position-relative" style="min-width:200px;">
                                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-4 mt-4"></i>
                                <input
                                    type="text"
                                    name="search"
                                    id="searchInput"
                                    value="{{ request('search') }}"
                                    class="form-control ps-12"
                                    placeholder="Cari Nama / ID Anggota..."
                                >
                            </div>

                            {{--  BULAN --}}
                            <div style="width:100px;">
                                <select name="bulan" class="form-select" data-control="select2" onchange="submitForm()">
                                    @for($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::create()->month($i)->isoFormat('MMMM') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            {{-- TAHUN --}}
                            <div style="width:100px;">
                                <select name="tahun" class="form-select" data-control="select2" onchange="submitForm()">
                                    @for($y = now()->year; $y >= now()->year - 5; $y--)
                                        <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>
                                            {{ $y }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            {{--  RESET --}}
                            <div class="d-flex align-items-center gap-2">
                                <a href="{{ url('/admin/layanan-kartu') }}" class="btn btn-light-danger">
                                    Reset
                                </a>

                                <div id="loadingSpinner" style="display:none;">
                                    <span class="spinner-border spinner-border-sm text-primary"></span>
                                </div>
                            </div>

                            {{-- ================= TOOLBAR ================= --}}
                            <div class="d-flex align-items-center gap-2 ms-auto flex-wrap">

                                {{--  CETAK --}}
                                @can('layanan kartu-cetak data')
                                <button type="button" onclick="cetakData()" class="btn btn-success">
                                    Cetak
                                </button>
                                @endcan

                                {{--  STATUS --}}
                                <div style="width:140px;">
                                    <select class="form-select" data-control="select2" onchange="filterStatus(this.value)">
                                        <option value="">Semua</option>
                                        <option value="null" {{ request('ket') == 'null' ? 'selected' : '' }}>Belum</option>
                                        <option value="Selesai" {{ request('ket') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                </div>

                                {{--  REKAP --}}
                                @can('layanan kartu-laporan')
                                    @if(!request('jk'))
                                    <a class="btn btn-primary" data-kt-menu-trigger="click">
                                        Rekap
                                    </a>

                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded
                                                menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-4">

                                        <div class="menu-item px-3">
                                            <a href="{{ route('laporan.harian', ['jk' => 'Putra', 'bulan' => $bulan, 'tahun' => $tahun]) }}"
                                            class="menu-link px-3">Putra</a>
                                        </div>

                                        <div class="menu-item px-3">
                                            <a href="{{ route('laporan.harian', ['jk' => 'Putri', 'bulan' => $bulan, 'tahun' => $tahun]) }}"
                                            class="menu-link px-3">Putri</a>
                                        </div>

                                    </div>
                                    @else
                                    <a href="{{ route('laporan.harian', ['jk' => request('jk'), 'bulan' => $bulan, 'tahun' => $tahun]) }}"
                                    class="btn btn-primary">
                                        Rekap
                                    </a>
                                    @endif
                                @endcan

                                {{-- TAMBAH --}}
                                @can('layanan kartu-tambah')
                                <button type="button" class="btn btn-light-success" data-bs-toggle="modal" data-bs-target="#kt_modal_add">
                                    Tambah
                                </button>
                                @endcan

                            </div>

                        </form>
                    </div>

                    @include('admin.Layanan.kartu.tambah')
                    <div class="card-body py-4">
                        <!--begin::Table-->
                        <div class="table-responsive">
                            <table class="table align-middle table-striped fs-6 gy-4">
                                <thead class="fw-bold fs-5 bg-success">
                                    <tr class="text-start text-white fw-bold fs-7 text-uppercase">
                                        <th class="rounded-start ps-5 min-w-200px">Hari, Tanggal</th>
                                        <th>ID Anggota</th>
                                        <th>Nama Anggota</th>
                                        <th>Kategori</th>
                                        <th>Petugas</th>
                                        <th>Shif</th>
                                        <th>Ket. Cetak</th>
                                        <th class="text-end rounded-end pe-5">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 fw-semibold">
                                @forelse ($kartu as $item)
                                    <tr>
                                        <td class="ps-5">
                                            {{ \Carbon\Carbon::parse($item->created_at)->isoFormat('dddd, D MMMM Y - HH:mm') }}
                                        </td>
                                        <td>
                                            {{ $item->idanggota }}
                                            @if($item->jk === 'Putra')
                                                <span class="badge badge-light-primary">Pa</span>
                                            @elseif($item->jk === 'Putri')
                                                <span class="badge badge-light-danger">Pi</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="text-gray-900 fs-5">{{ $item->nama }}</div>
                                            <span class="text-muted fs-7 d-block">
                                                Asrama: {{ $item->asrama }}
                                            </span>
                                        </td>
                                        <td>
                                            @php
                                                $kategoriClass = match($item->kategori) {
                                                    'Mahasiswa Baru' => 'badge-light-primary',
                                                    'Perpanjang/Cetak Ulang' => 'badge-light-warning',
                                                    'Anggota Baru' => 'badge-light-success',
                                                    default => 'badge-light-secondary'
                                                };
                                            @endphp
                                            <span class="badge py-3 px-4 fs-7 {{ $kategoriClass }}">
                                                {{ $item->kategori }}
                                            </span>
                                        </td>
                                        <td>{{ $item->petugas }}</td>
                                        <td>{{ $item->shif }}</td>
                                        <td>
                                            @if($item->ket === 'Selesai')
                                                <span class="badge py-3 px-4 fs-7 badge-light-success">
                                                    Selesai
                                                </span>
                                            @else
                                                @can('layanan kartu-ubah')
                                                    <a href="#"
                                                    class="btn btn-light-danger btn-sm"
                                                    onclick="event.preventDefault(); document.getElementById('label-{{ $item->id }}').submit();">
                                                        Belum
                                                    </a>
                                                    <form id="label-{{ $item->id }}"
                                                        action="{{ url('/admin/layanan-kartu/'.$item->id.'/ubah') }}"
                                                        method="POST" class="d-none">
                                                        @csrf
                                                        <input type="hidden" name="ket" value="Selesai">
                                                        <input type="hidden" name="slug2"
                                                            value="{{ $item->kategori.'-'.\Carbon\Carbon::parse($item->created_at)->isoFormat('MMMM-Y').'-'.$item->jk }}">
                                                    </form>
                                                @else
                                                    <span class="badge py-3 px-4 fs-7 badge-light-danger">
                                                        Belum
                                                    </span>
                                                @endcan
                                            @endif
                                        </td>
                                        <td class="text-end pe-5">
                                            <a href="#"
                                            class="btn btn-light-primary btn-sm btn-icon"
                                            data-kt-menu-trigger="click"
                                            data-kt-menu-placement="bottom-end">
                                                <i class="ki-duotone ki-down fs-5"></i>
                                            </a>
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded
                                                        menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                data-kt-menu="true">
                                                @can('layanan kartu-edit')
                                                <div class="menu-item px-3">
                                                    <a href="#"
                                                    class="menu-link px-3"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#kt_modal_edit{{ $item->id }}">
                                                        Edit
                                                    </a>
                                                </div>
                                                @endcan
                                                @can('layanan kartu-hapus')
                                                <div class="menu-item px-3">
                                                    <a href="{{ url('/admin/layanan-kartu/'.$item->id.'/hapus') }}"
                                                    class="menu-link px-3 delete-button">
                                                        Hapus
                                                    </a>
                                                </div>
                                                @endcan
                                            </div>
                                            @include('admin.Layanan.kartu.edit')
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-10">
                                            Data tidak ditemukan
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!--end::Table-->
                        <!--begin::Pagination-->
                        @if ($kartu->hasPages())
                        <div class="d-flex flex-stack flex-wrap py-5 px-4">
                            <div class="fs-6 fw-semibold text-gray-700">
                                Menampilkan {{ $kartu->firstItem() }} –
                                {{ $kartu->lastItem() }} dari {{ $kartu->total() }} data
                            </div>
                            <div>
                                {{ $kartu->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                        @endif
                        <!--end::Pagination-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
const form = document.getElementById('filterForm');
const input = document.getElementById('searchInput');
const spinner = document.getElementById('loadingSpinner');

// ✅ SEARCH hanya ENTER
input.addEventListener('keypress', function (e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        showLoading();
        form.submit();
    }
});

// ✅ dropdown auto submit
function submitForm() {
    showLoading();
    form.submit();
}

// ✅ loading
function showLoading() {
    if (spinner) {
        spinner.style.display = 'inline-block';
    }
}

// ✅ filter status (tidak hilang filter lain)
function filterStatus(value) {
    const url = new URL(window.location.href);
    const params = url.searchParams;

    // ambil semua input dari form
    const formData = new FormData(document.getElementById('filterForm'));
    formData.forEach((val, key) => {
        if (val) {
            params.set(key, val);
        } else {
            params.delete(key);
        }
    });

    // set status
    if (value) {
        params.set('ket', value);
    } else {
        params.delete('ket');
    }

    // redirect aman
    window.location.href = url.toString();
}

//CETAK ikut semua filter
function cetakData() {
    const form = document.getElementById('filterForm');
    const params = new URLSearchParams(new FormData(form));

    // ambil bulan & tahun
    let bulan = params.get('bulan');
    let tahun = params.get('tahun');
    let jk    = params.get('jk');

    // 🔥 DEFAULT jika kosong
    const now = new Date();

    if (!bulan) {
        bulan = (now.getMonth() + 1).toString(); // bulan sekarang
        params.set('bulan', bulan);
    }

    if (!tahun) {
        tahun = now.getFullYear().toString();
        params.set('tahun', tahun);
    }

    // 🔥 JK default = Semua (Putra + Putri)
    if (!jk) {
        jk = 'Semua';
    }

    const url = new URL(`/admin/layanan-kartu/export-data/${jk}`, window.location.origin);
    url.search = params.toString();

    window.location.href = url.toString();
}

// ✅ reset spinner saat back
window.addEventListener('pageshow', function () {
    if (spinner) spinner.style.display = 'none';
});
</script>


@include('layout.footer')


@endsection
