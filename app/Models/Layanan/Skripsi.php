<?php

namespace App\Models\Layanan;

use App\Models\Prodi;
use Illuminate\Database\Eloquent\Model;

class Skripsi extends Model
{
    //
    protected $table = 'skripsis';

    protected $guarded = ['id'];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function layananPlagiasi()
    {
        return $this->belongsTo(Layanan_plagiasi::class);
    }
}
