<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('layanan_bebastanggungans', function (Blueprint $table) {
            $table->id();
            $table->string('angkatan');
            $table->string('nim');
            $table->string('nama');
            $table->string('pend_pagi');
            // $table->string('fakultas');
            $table->string('prodi');
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->string('provinsi');
            $table->string('asrama');
            $table->string('judul');
            $table->string('ket')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan_bebastanggungans');
    }
};
