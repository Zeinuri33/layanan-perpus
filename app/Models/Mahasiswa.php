<?php

namespace App\Models;

use App\Models\Layanan\Layanan_plagiasi;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswas';
    protected $guarded = ['id'];

    public function plagiasi()
    {
        return $this->hasMany(Layanan_plagiasi::class, 'mahasiswa');
    }

    public function programstudi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }
}
