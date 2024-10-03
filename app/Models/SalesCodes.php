<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesCodes extends Model
{
    protected $table = 'sales_codes';
    
    protected $fillable = [
        'id', 'mitra_nama', 'nama', 'sto', 'id_mitra', 'nama_mitra', 'role',
        'kode_agen', 'kode_baru', 'no_telp_valid', 'nama_sa_2', 'status_wpi',
    ];

    public $timestamps = true;
}
