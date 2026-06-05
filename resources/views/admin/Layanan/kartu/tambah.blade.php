<!--begin::Modal-->
<div class="modal fade" id="kt_modal_add" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-600px">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
            </div>

            <!-- Body -->
            <div class="modal-body scroll-y px-15 px-lg-15 pt-0 pb-15">

                @php
                    $hour = now()->hour;

                    $shiftMap = [
                        'Siang' => $hour >= 13 && $hour < 17,
                        'Malam' => $hour >= 20 && $hour < 22,
                    ];

                    $shift = 'di Luar Jam Kerja';

                    foreach ($shiftMap as $key => $condition) {
                        if ($condition) {
                            $shift = $key;
                            break;
                        }
                    }

                    $shiftText = match($shift) {
                        'Siang' => 'Tambahkan data anggota kartu pada shif siang.',
                        'Malam' => 'Tambahkan data anggota kartu pada shif malam.',
                        default => 'Tambahkan data anggota kartu di luar jam kerja.',
                    };


                    $petugasMap = [
                        'Putra' => ['Slamet','Harif','Syamsuddin','Dani','Mustofa','Mahmudi','Hasyim','Syaikhoni' ,'Jalik' ,'Tista'],
                        'Putri' => ['Farah Lailatul Maulida','Camelia Putri Amalia'],
                    ];

                    $petugasList = $petugasMap[$jk] ?? [];
                @endphp
                
                <!-- Heading -->
                <div class="mb-8 text-center">
                    <h1 class="mb-3">Tambah Data</h1>
                    <div class="text-muted fw-semibold fs-5">{{ $shiftText }}</div>
                </div>

                <!-- CEK ID ANGGOTA -->
                <div id="cardCekAnggota" class="card bg-secondary mb-5">
                    <div class="card-body">

                        <form id="cekAnggotaForm">
                            <label class="fw-semibold text-white">Cek ID Anggota OPAC</label>

                            <div class="d-flex gap-2 mt-2">
                                <input type="text" id="cek_idanggota" class="form-control" placeholder="Masukkan ID Anggota">
                                <button class="btn btn-primary" type="submit">Cek</button>
                            </div>

                            <div id="result" class="mt-3 text-white"></div>
                        </form>

                    </div>
                </div>

                <!-- Form -->
                <form method="POST" enctype="multipart/form-data" action="/admin/layanan-kartu">
                    @csrf


                    <!-- JK -->
                    <div class="fv-row mb-8">
                        <label class="required fw-semibold fs-6 mb-2">Jenis Kelamin</label>

                        <select name="jk" id="jk" class="form-select" data-control="select2" data-hide-search="true" data-placeholder="Pilih Jenis Kelamin" required>

                            <option></option>
                            <option value="Putra" {{ $jk == 'Putra' ? 'selected' : '' }}>Putra</option>
                            <option value="Putri" {{ $jk == 'Putri' ? 'selected' : '' }}>Putri</option>
                        </select>
                    </div>

                    <!-- ID Anggota -->
                    <div class="fv-row mb-8">
                        <label class="required fw-semibold fs-6 mb-2">ID Anggota OPAC</label>
                        <input type="text" name="idanggota" id="idanggota" class="form-control" placeholder="ID Anggota OPAC" required>
                    </div>

                    <!-- Nama -->
                    <div class="fv-row mb-8">
                        <label class="required fw-semibold fs-6 mb-2">Nama Anggota</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Anggota" required>
                    </div>

                    <!-- Asrama -->
                    <div class="fv-row mb-8">
                        <label class="required fw-semibold fs-6 mb-2">Asrama</label>
                        <input type="text" name="asrama" id="asrama" class="form-control" placeholder="Asrama (kode)" required>
                    </div>

                    <!-- Kategori -->
                    <div class="fv-row mb-8">
                        <label class="required fw-semibold fs-6 mb-2">Kategori</label>
                        <select class="form-select" name="kategori" data-control="select2" data-hide-search="true" data-placeholder="Pilih Kategori Cetak" required>
                            <option></option>
                            @foreach(['Anggota Baru','Perpanjang/Cetak Ulang','Mahasiswa Baru'] as $kat)
                                <option value="{{ $kat }}">{{ $kat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Petugas -->
                    <div class="fv-row mb-8">
                        <label class="required fw-semibold fs-6 mb-2">Petugas</label>
                        <select class="form-select" name="petugas" data-control="select2" data-hide-search="true" data-placeholder="Pilih Petugas">
                            <option value="{{ auth()->user()->name }}">{{ auth()->user()->name }}</option>
                            @foreach($petugasList as $p)
                                <option value="{{ $p }}">{{ $p }}</option>
                            @endforeach
                        </select>
                    </div>

                    <input type="hidden" name="shif" value="{{ $shift }}">
                    <div class="d-flex flex-stack mb-14">
                        <!--begin::Label-->
                        <div class="me-5">
                            <label class="fs-6 fw-semibold">Keterangan Cetak</label>
                            <div class="fs-7 fw-semibold text-muted">Klik jika kartu selesai dicetak</div>
                        </div>
                        <!--end::Label-->
                        <!--begin::Switch-->
                        <label class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" name="ket" type="checkbox" value="Selesai" checked="checked">
                            <span class="form-check-label fw-semibold text-muted">Tercetak</span>
                        </label>
                        <!--end::Switch-->
                    </div>


                    <!-- Action -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script src="admin/assets/plugins/global/plugins.bundle.js"></script>
<script src="admin/assets/js/custom/utilities/modals/bidding.js"></script>
<!-- SCRIPT -->
<script>
document.getElementById('cekAnggotaForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const id = document.getElementById('cek_idanggota').value;
    const url = `https://opac.lib.ibrahimy.ac.id/api/AnggotaApiController.php?member_id=${encodeURIComponent(id)}&token=lib180597`;

    const result = document.getElementById('result');
    const card = document.getElementById('cardCekAnggota');

    // reset ke abu-abu dulu
    card.className = 'card bg-secondary mb-5';
    result.innerHTML = 'Memuat data...';

    fetch(url)
        .then(res => res.json())
        .then(data => {

            if (data.status === 'success') {
                const m = data.data;

                // AUTO FILL
                document.getElementById('idanggota').value = m.member_id || '';
                document.getElementById('nama').value = m.member_name || '';
                document.getElementById('jk').value = m.gender == 1 ? 'Putra' : 'Putri';
                document.getElementById('asrama').value = m.member_address || '';

                // UBAH WARNA JADI HIJAU
                card.className = 'card bg-success mb-5';

                result.innerHTML = `
                    <strong>Data ditemukan</strong><br>
                    ${m.member_name}
                `;

            } else {
                // MERAH
                card.className = 'card bg-danger mb-5';

                result.innerHTML = `Data tidak ditemukan`;
            }
        })
        .catch(() => {
            // ERROR → MERAH
            card.className = 'card bg-danger mb-5';

            result.innerHTML = `Terjadi kesalahan saat mengambil data`;
        });
});
</script>