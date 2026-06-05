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
        Schema::create('skripsis', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('layanan_plagiasi_id')->nullable();
            $table->string('label');
            $table->string('nim');
            $table->string('pengarang');
            $table->string('judul');
            $table->unsignedBigInteger('prodi_id')->nullable();
            $table->timestamps();

            $table->foreign('layanan_plagiasi_id')->references('id')->on('layanan_plagiasis')->nullOnDelete();
            $table->foreign('prodi_id')->references('id')->on('prodis')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skripsis');
    }
};
