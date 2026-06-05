<!--begin::Modal - Update user details-->
<div class="modal fade" id="kt_modal_tambah" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-900px">
        <!--begin::Modal content-->
        <div class="modal-content modal-rounded">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y px-20 px-lg-25 pt-0 pb-15">
                <form method="POST" action="{{ route('transaksi.tambah') }}">
                    <div class="mb-13 text-center">
						<!--begin::Title-->
						<h1 class="mb-3">Transaksi Baru</h1>
						<!--end::Title-->
						<!--begin::Description-->
						<div class="text-muted fw-semibold fs-5">Jika produk tidak ada, coba cek di
						<a href="/admin/kasir-produk" class="fw-bold link-primary">Data Produk</a>.</div>
						<!--end::Description-->
					</div>
                    @csrf
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-4" id="produkTable">
                            <thead class="text-start fw-bold fs-6 text-uppercase gs-0">
                                <tr class="fw-bold text-white bg-primary">
                                    <th width="35%" class="ps-4 rounded-start align-middle">Produk</th>
                                    <th width="20%" class="align-middle">Harga</th>
                                    <th width="15%" class="align-middle">Jumlah</th>
                                    <th width="25%" class="align-middle">Subtotal</th>
                                    <th width="5%" class="rounded-end"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <script type="text/template" id="produk-row-template">
                                <tr>
                                    <td>
                                        <select name="produk_id[]" class="form-select produk-select">
                                            <option value="">Pilih Produk</option>
                                            @foreach ($produks as $produk)
                                                <option value="{{ $produk->id }}" data-harga="{{ $produk->harga }}">{{ $produk->produk }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="text" class="form-control harga" readonly>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="number" name="qty[]" class="form-control qty" min="1" value="1">
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="text" name="subtotal[]" class="form-control subtotal" readonly>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <button type="button" class="btn btn-icon btn-light-danger remove-row">
                                            <i class="ki-outline ki-trash fs-2"></i>
                                        </button>
                                    </td>
                                </tr>
                                </script>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end mb-8">
                        <button type="button" id="addRow" class="btn btn-primary hover-scale">
                            <i class="ki-outline ki-plus-square fs-2"></i>Tambah Produk
                        </button>
                    </div>
                    <div class="separator mb-5"></div>

                    <div class="row mb-4">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label fw-semibold fs-6 required">Uang yang dibayarkan</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8">
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="uang_dibayar" id="uang_dibayar" class="form-control" placeholder="Masukkan Jumlah Uang yang dibayarkan" required>
                            </div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--begin::Summary-->
                    <div class="bg-success rounded-3 p-6 mb-11">
                        <div class="text-white">

                            <div class="d-flex justify-content-between align-items-center border-bottom border-white border-opacity-25 mb-2 pb-2">
                                <span class="fs-4">Total Harga</span>
                                <span class="fs-4 fw-bold" id="summary_total_asli">Rp. 0</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center border-bottom border-white border-opacity-25 mb-2 pb-2">
                                <span class="fs-4">Diskon</span>
                                <span class="fs-4 fw-bold" id="summary_potongan">-Rp. 0</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center border-bottom border-white border-opacity-25 mb-2 pb-2">
                                <span class="fs-4">Donasi</span>
                                <span class="fs-4 fw-bold" id="summary_donasi">Rp. 0</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center border-bottom border-white border-opacity-25 mb-2 pb-2">
                                <span class="fs-2 fw-bold">Total</span>
                                <span class="fs-2 fw-bold" id="summary_total_final">Rp. 0</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center border-bottom border-white border-opacity-25 mb-2 pb-2">
                                <span class="fs-4">Uang Dibayar</span>
                                <span class="fs-4 fw-bold" id="summary_uang_dibayar">Rp. 0</span>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fs-4 fw-bold">Kembalian</span>
                                <span class="fs-4 fw-bold" id="summary_kembalian">Rp. 0</span>
                            </div>

                        </div>
                    </div>
                    <!--end::Summary-->
                    <input type="hidden" id="total_asli" class="form-control" readonly>
                    <input type="hidden" name="potongan" id="potongan" class="form-control" readonly>
                    <input type="hidden" id="donasi" name="donasi_tampil" class="form-control" readonly>
                    <input type="hidden" id="kembalian" class="form-control" readonly>
                    <input type="hidden" id="total" class="form-control" readonly>
                    
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success hover-scale" id="btnSimpanTransaksi">
                            <i class="ki-outline ki-check-square fs-2"></i>Simpan Transaksi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end::Modal - Update user details-->

<script src="{{ asset('admin/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('admin/assets/js/scripts.bundle.js') }}"></script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        function formatRupiah(angka) {
            return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function parseRupiah(str) {
            return parseInt((str || '0').replace(/\./g, '')) || 0;
        }

        function updateSubtotal(row) {
            const harga = parseRupiah(row.querySelector('.harga').value);
            const qty = parseInt(row.querySelector('.qty').value) || 1;
            const subtotal = harga * qty;
            row.querySelector('.subtotal').value = formatRupiah(subtotal);
            updateTotal();
        }

        function updateSummaryUI() {
            const parse = (id) => parseInt((document.getElementById(id)?.value || '0').replace(/\./g, '')) || 0;
            const format = (angka) => 'Rp. ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");

            const total_asli = parse('total_asli');
            const potongan = parse('potongan');
            const donasi = parse('donasi');
            const uang_dibayar = parse('uang_dibayar');
            const total_final = total_asli - potongan + donasi;
            const kembalian = uang_dibayar - total_final;

            document.getElementById('summary_total_asli').textContent = format(total_asli);
            document.getElementById('summary_potongan').textContent = '-' + format(potongan);
            document.getElementById('summary_donasi').textContent = format(donasi);
            document.getElementById('summary_total_final').textContent = format(total_final);
            document.getElementById('summary_uang_dibayar').textContent = format(uang_dibayar);
            document.getElementById('summary_kembalian').textContent = format(kembalian);
        }



        function updateTotal() {
            let total = 0;
            document.querySelectorAll('.subtotal').forEach(el => {
                total += parseRupiah(el.value);
            });

            // Potongan otomatis
            const mod = total % 500;
            let potongan = 0;
            if (mod > 0 && mod < 300) {
                potongan = mod;
            }

            // Donasi otomatis
            let donasi = 0;
            if (mod > 0) {
                const selisih = 500 - mod;
                if (selisih < 300) {
                    donasi = selisih;
                }
            }

            const totalAkhir = total - potongan + donasi;
            const bayar = parseRupiah(document.getElementById('uang_dibayar').value);

            document.getElementById('total_asli').value = formatRupiah(total);
            document.getElementById('potongan').value = formatRupiah(potongan);
            document.getElementById('donasi').value = formatRupiah(donasi);
            document.getElementById('total').value = formatRupiah(totalAkhir);
            document.getElementById('kembalian').value = formatRupiah(bayar - totalAkhir);

            updateSummaryUI();
        }




        function initSelect2(context = document) {
            $(context).find('.produk-select').select2({
                placeholder: "Pilih Produk",
                dropdownParent: $('#kt_modal_tambah'),
                width: '100%',
                allowClear: true
            });
        }

        // Inisialisasi select2 saat modal dibuka
        $('#kt_modal_tambah').on('shown.bs.modal', function () {
            initSelect2(); // aktifkan semua select2 yang belum aktif
        });

        // Event: pilih produk
        $('#produkTable').on('change', '.produk-select', function () {
            const row = this.closest('tr');
            const harga = this.options[this.selectedIndex].dataset.harga || 0;
            row.querySelector('.harga').value = formatRupiah(harga);
            updateSubtotal(row);
        });

        // Event: jumlah diubah
        $('#produkTable').on('input', '.qty', function () {
            updateSubtotal(this.closest('tr'));
        });

        // Event: uang dibayar
        $('#uang_dibayar').on('input', updateTotal);

        
        // ✅ Event: potongan diubah
        $('#potongan').on('input', updateTotal);

        // Tambah baris baru dari template
        document.getElementById('addRow').addEventListener('click', function () {
            const tbody = document.querySelector('#produkTable tbody');
            const template = document.getElementById('produk-row-template').innerHTML;

            tbody.insertAdjacentHTML('beforeend', template);
            const newRow = tbody.lastElementChild;

            initSelect2(newRow); // aktifkan select2 pada row baru
            updateSubtotal(newRow); // inisialisasi subtotal
        });

        // Hapus baris
        $('#produkTable').on('click', '.remove-row', function () {
            $(this).closest('tr').remove();
            updateTotal();
        });
        
    });
</script>



@if(session('cetak'))
<script>
    const cetakId = "{{ session('cetak') }}";
    if (cetakId) {
        Swal.fire({
            title: 'Alhamdulillah!',
            text: "Transaksi berhasil, ingin cetak nota sekarang?",
            icon: 'success',
            showCancelButton: true,
            confirmButtonText: 'Ya, Cetak',
            cancelButtonText: 'Nanti saja',
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-light-warning'
            },
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                const url = `/transaksi/cetak/${cetakId}`;
                window.open(url, '_blank');
            }
        });
    }
</script>

@endif


