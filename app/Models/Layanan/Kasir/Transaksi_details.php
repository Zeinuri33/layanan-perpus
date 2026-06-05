<?php

namespace App\Models\Layanan\Kasir;

use Illuminate\Database\Eloquent\Model;

class Transaksi_details extends Model
{
    //
    
    protected $table = 'transaksi_details';
    protected $guarded = ['id'];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

}
