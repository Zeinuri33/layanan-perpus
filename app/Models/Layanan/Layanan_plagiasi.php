<?php

namespace App\Models\Layanan;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Model;

class Layanan_plagiasi extends Model
{
    //
    protected $table = 'layanan_plagiasis';

    protected $guarded = ['id'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }
    public function dosen2()
    {
        return $this->belongsTo(Dosen::class, 'dosen2_id');
    }

    public function riwayatPlagiasi()
    {
        return $this->hasMany(Riwayat_plagiasi::class);
    }


}
