<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Layanan\BebasTanggunganController;
use App\Http\Controllers\Layanan\CekplagiasiController;
use App\Http\Controllers\Layanan\CekplagiasiNonTAController;
use App\Http\Controllers\Layanan\KartuController;
use App\Http\Controllers\Layanan\Kasir\ProdukController;
use App\Http\Controllers\Layanan\Kasir\TransaksiController;
use App\Http\Controllers\Layanan\SkripsiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Universitas\DosenController;
use App\Http\Controllers\Universitas\MahasiswaController;
use App\Http\Controllers\Universitas\ProdiController;
use App\Http\Controllers\User\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\PermissionMiddleware;
use Illuminate\Support\Facades\Route;











// Halaman utama bisa diakses oleh semua orang tanpa middleware
Route::get('/', function () {
    return redirect('/admin/home');
});

// Area Admin
Route::get('/login',[LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login',[LoginController::class, 'login']);

Route::get('/logout',[LoginController::class, 'logout'])->name('logout');


// Middleware hanya untuk pengguna dengan izin "manage users"
Route::middleware(['auth', PermissionMiddleware::class . ':pengguna-lihat'])->group(function () {
    Route::resource('/admin/pengguna', UserController::class);
});
Route::middleware(['auth', PermissionMiddleware::class . ':pengguna-ubah password'])->group(function () {
    Route::post('/admin/pengguna/ubahpassword({id})', [UserController::class, 'ubahpassword']);
});
Route::middleware(['auth', PermissionMiddleware::class . ':pengguna-hapus'])->group(function () {
    Route::get('/admin/pengguna({id})/hapus', [UserController::class, 'hapus']);
});
Route::middleware(['auth', PermissionMiddleware::class . ':pengguna-akses pengguna'])->group(function () {
    Route::get('/admin/pengguna-akses({id})', [UserController::class, 'akses']);
    Route::post('/admin/pengguna-akses/{id}/update', [UserController::class, 'updateAkses']);
});

Route::middleware(['auth', PermissionMiddleware::class . ':akses pengguna-lihat'])->group(function () {
    Route::resource('/admin/pengguna-akses', PermissionController::class);
});
Route::middleware(['auth', PermissionMiddleware::class . ':akses pengguna-hapus'])->group(function () {
    Route::get('/admin/pengguna-akses/{id}/hapus', [PermissionController::class, 'destroy']);
});



//Kartu Anggota
Route::middleware(['auth', PermissionMiddleware::class . ':layanan kartu-lihat'])->group(function () {
    Route::resource('/admin/layanan-kartu', KartuController::class);
});
Route::middleware(['auth', PermissionMiddleware::class . ':layanan kartu-hapus'])->group(function () {
    Route::get('/admin/layanan-kartu/{id}/hapus', [KartuController::class, 'hapus']);
});
Route::middleware(['auth', PermissionMiddleware::class . ':layanan kartu-ubah'])->group(function () {
    Route::post('/admin/layanan-kartu({id})/ubah', [KartuController::class, 'ubah']);
});
Route::middleware(['auth', PermissionMiddleware::class . ':layanan kartu-putra'])->group(function () {
    Route::get('/admin/layanan-kartu(Putra)', [KartuController::class, 'putraputri']);
});
Route::middleware(['auth', PermissionMiddleware::class . ':layanan kartu-putri'])->group(function () {
    Route::get('/admin/layanan-kartu(Putri)', [KartuController::class, 'putraputri']);
});

Route::middleware(['auth', PermissionMiddleware::class . ':layanan kartu-laporan'])->group(function () {
    Route::get('/admin/layanan-kartu={jk?}', [KartuController::class, 'laporan'])->name('laporan.harian');
});
Route::middleware(['auth', PermissionMiddleware::class . ':layanan kartu-cetak laporan'])->group(function () {
    Route::get('/laporan/export/{jk?}', [KartuController::class, 'exportLaporan'])->name('laporan.kartu.export');
});
Route::middleware(['auth', PermissionMiddleware::class . ':layanan kartu-cetak data'])->group(function () {
    Route::get('/admin/layanan-kartu/export-data/{jk}', [KartuController::class, 'exportData'])->name('layanan.kartu.export.data');
});

//Bebas Pustaka
Route::middleware(['auth', PermissionMiddleware::class . ':layanan bebas pustaka-angkatan 2020'])->group(function () {
    Route::resource('/admin/layanan-bebaspustaka', BebasTanggunganController::class);
});
Route::middleware(['auth', PermissionMiddleware::class . ':layanan bebas pustaka-edit'])->group(function () {
    Route::get('/admin/layanan-bebaspustaka({id})=edit', [BebasTanggunganController::class, 'edit']);
});
Route::middleware(['auth', PermissionMiddleware::class . ':layanan bebas pustaka-export'])->group(function () {
    Route::get('/export/{angkatan}', [BebasTanggunganController::class, 'export'])->name('export.bebaspustaka');
    Route::get('/bebaspustaka/export', [CekplagiasiController::class, 'export'])->name('bebaspustaka.export');
});

Route::get('/bebaspustaka={id}', [BebasTanggunganController::class, 'cetak']);

Route::get('/layanan-bebaspustaka={id}/verifikasi', [BebasTanggunganController::class, 'verifikasi']);
Route::post('/layanan-bebaspustaka/{id}/verifikasi', [BebasTanggunganController::class, 'verified']);

Route::middleware(['auth', PermissionMiddleware::class . ':layanan bebas pustaka-lihat'])->group(function () {
    Route::get('/admin/layanan-bebaspustaka({id})/hapus', [BebasTanggunganController::class, 'hapus']);
});

Route::middleware(['auth', PermissionMiddleware::class . ':layanan bebas pustaka-lihat'])->group(function () {
    Route::get('/admin/layanan-ketbebaspustaka', [CekplagiasiController::class, 'bebaspustaka']);
    Route::get('/admin/layanan-ketbebaspustaka=jumlah', [CekplagiasiController::class, 'jumlah'])->name('bebaspustaka.jumlah');
});
Route::middleware(['auth', PermissionMiddleware::class . ':layanan bebas pustaka-kirim'])->group(function () {
    Route::post('/admin/layanan-ketbebaspustaka/{id}/kirim', [CekplagiasiController::class, 'kirim'])->name('kirim');
});

Route::get('/layanan-ketbebaspustaka={id}/verifikasi', [CekplagiasiController::class, 'verifikasi']);
Route::post('/layanan-ketbebaspustaka/{id}/verifikasi', [CekplagiasiController::class, 'verified']);
Route::get('/ketbebaspustaka={id}', [CekplagiasiController::class, 'cetak_ket']);
Route::get('/pernyataanpublikasi={id}', [CekplagiasiController::class, 'cetak_per']);




//layanan Cek Plagiasi
Route::middleware(['auth', PermissionMiddleware::class . ':layanan cekplagiasi-lihat'])->group(function () {
    Route::resource('/admin/layanan-cekplagiasi', CekplagiasiController::class);
    Route::resource('/admin/layanan-plagiasi', CekplagiasiNonTAController::class);
    Route::post('/admin/layanan-cekplagiasi/{id}/upload-ulang', [CekplagiasiController::class, 'uploadUlang']);
    Route::post('/admin/layanan-plagiasi/{id}/upload-ulang', [CekplagiasiNonTAController::class, 'uploadUlangDoc'])->name('nonta.uploadulang');
});
Route::middleware(['auth', PermissionMiddleware::class . ':layanan cekplagiasi-tambah'])->group(function () {
    Route::get('/admin/layanan-cekplagiasi=tambah', [CekplagiasiController::class, 'create']);
    Route::post('/admin/layanan-cekplagiasi/tambah', [CekplagiasiController::class, 'tambah']);
});
Route::middleware(['auth', PermissionMiddleware::class . ':layanan cekplagiasi-edit'])->group(function () {
    Route::get('/admin/layanan-cekplagiasi-{id}=edit', [CekplagiasiController::class, 'edit']);
    Route::post('/admin/layanan-cekplagiasi/{id}/perbarui', [CekplagiasiController::class, 'perbarui']);
});
Route::middleware(['auth', PermissionMiddleware::class . ':layanan cekplagiasi-hapus'])->group(function () {
    Route::get('/admin/layanan-cekplagiasi/{id}/hapus', [CekplagiasiController::class, 'destroy']);
    Route::get('/admin/layanan-plagiasi/{id}/hapus', [CekplagiasiNonTAController::class, 'destroy']);
});
Route::middleware(['auth', PermissionMiddleware::class . ':layanan cekplagiasi-rekap'])->group(function () {
    Route::get('/admin/layanan-cekplagiasi=rekap', [CekplagiasiController::class, 'rekap']);
});
Route::middleware(['auth', PermissionMiddleware::class . ':layanan cekplagiasi-hasil'])->group(function () {
    Route::post('/admin/layanan-cekplagiasi/{id}/hasil', [CekplagiasiController::class, 'hasil']);
    Route::post('/admin/layanan-plagiasi/{id}/hasil', [CekplagiasiNonTAController::class, 'hasil']);
});
Route::middleware(['auth', PermissionMiddleware::class . ':layanan cekplagiasi-hasil'])->group(function () {
    Route::get('/admin/layanan-cekplagiasi/{id}/hapus-hasil', [CekplagiasiController::class, 'hapushasil'])->name('riwayat.destroy');;
});
Route::middleware(['auth', PermissionMiddleware::class . ':layanan cekplagiasi-file'])->group(function () {
    Route::get('/admin/layanan-cekplagiasi/download/{id}', [CekplagiasiController::class, 'download'])->name('plagiasi.download');
    Route::get('/admin/layanan-plagiasi/download/{id}', [CekplagiasiNonTAController::class, 'download'])->name('nonta.download');
});



Route::get('/layanan-cekplagiasi/hasil/{id}', [CekplagiasiController::class, 'downloadhasil'])->name('hasil.download');
Route::get('/hasilcekplagiasi={id}', [CekplagiasiController::class, 'cetak']);
Route::get('/hasilplagiasi={id}', [CekplagiasiNonTAController::class, 'cetak']);

// Middleware hanya untuk pengguna yang sudah login
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/home', [HomeController::class, 'index'])->name('home-user');
});

//Dosen
Route::middleware(['auth', PermissionMiddleware::class . ':dosen-lihat'])->group(function () {
    Route::resource('/admin/dosen', DosenController::class);
});
Route::middleware(['auth', PermissionMiddleware::class . ':dosen-edit'])->group(function () {
    Route::get('/admin/dosen={id}', [DosenController::class, 'edit']);
});
Route::middleware(['auth', PermissionMiddleware::class . ':dosen-hapus'])->group(function () {
    Route::get('/admin/dosen/{id}/hapus', [DosenController::class, 'destroy']);
});

//Mahasiswa
Route::middleware(['auth', PermissionMiddleware::class . ':mahasiswa-lihat'])->group(function () {
    Route::resource('/admin/mahasiswa', MahasiswaController::class);
});
Route::middleware(['auth', PermissionMiddleware::class . ':mahasiswa-edit'])->group(function () {
    Route::get('/admin/mahasiswa={id}', [MahasiswaController::class, 'edit']);
});
Route::middleware(['auth', PermissionMiddleware::class . ':mahasiswa-hapus'])->group(function () {
    Route::get('/admin/mahasiswa/{id}/hapus', [MahasiswaController::class, 'destroy']);
});


//Program Studi
Route::middleware(['auth', PermissionMiddleware::class . ':program studi-lihat'])->group(function () {
    Route::resource('/admin/prodi', ProdiController::class);
});

Route::middleware(['auth', PermissionMiddleware::class . ':program studi-hapus'])->group(function () {
    Route::get('/admin/prodi/{id}/hapus', [ProdiController::class, 'destroy']);
});


//Kasir Produk
Route::middleware(['auth', PermissionMiddleware::class . ':kasir produk-lihat'])->group(function () {
    Route::resource('/admin/kasir-produk', ProdukController::class);
});
Route::middleware(['auth', PermissionMiddleware::class . ':kasir produk-hapus'])->group(function () {
    Route::get('/admin/kasir-produk/{id}/hapus', [ProdukController::class, 'destroy']);
});

//Kasir Transaksi
Route::middleware(['auth', PermissionMiddleware::class . ':kasir transaksi-lihat'])->group(function () {
    Route::resource('/admin/kasir-transaksi', TransaksiController::class);
});
Route::middleware(['auth', PermissionMiddleware::class . ':kasir transaksi-tambah'])->group(function () {
    Route::post('/transaksi/tambah', [TransaksiController::class, 'store'])->name('transaksi.tambah');
});
Route::middleware(['auth', PermissionMiddleware::class . ':kasir transaksi-cetak'])->group(function () {
    Route::get('/transaksi/cetak/{id}', [TransaksiController::class, 'cetak'])->name('transaksi.cetak');
});
Route::middleware(['auth', PermissionMiddleware::class . ':kasir transaksi-hapus'])->group(function () {
    Route::get('/transaksi/hapus/{id}', [TransaksiController::class, 'hapus']);
});
Route::middleware(['auth', PermissionMiddleware::class . ':kasir transaksi-laporan'])->group(function () {
    Route::get('/admin/kasir-laporan', [TransaksiController::class, 'laporan'])->name('laporan');
});


//Skripsi
Route::middleware(['auth', PermissionMiddleware::class . ':skripsi-lihat'])->group(function () {
    Route::resource('/admin/skripsi', SkripsiController::class);
    Route::get('/admin/layanan-skripsi', [SkripsiController::class, 'latest']);
});
Route::middleware(['auth', PermissionMiddleware::class . ':skripsi-hapus'])->group(function () {
    Route::get('/admin/skripsi/{id}/hapus', [SkripsiController::class, 'destroy']);
});

Route::get('/katalog-skripsi', [SkripsiController::class, 'katalog'])->name('skripsi.katalog');

