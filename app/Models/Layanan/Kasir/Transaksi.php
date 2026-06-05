<?php

namespace App\Models\Layanan\Kasir;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    //
    protected $table = 'transaksis';
    protected $guarded = ['id'];

    public function details()
    {
        return $this->hasMany(Transaksi_details::class);
    }
    
}
