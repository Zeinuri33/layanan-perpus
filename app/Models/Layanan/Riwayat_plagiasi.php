<?php

namespace App\Models\Layanan;

use Illuminate\Database\Eloquent\Model;

class Riwayat_plagiasi extends Model
{
    //
    protected $fillable = [
        'layanan_plagiasi_id',
        'persentase',
        'hasil',
    ];

    public function layananPlagiasi()
    {
        return $this->belongsTo(Layanan_plagiasi::class);
    }
}
