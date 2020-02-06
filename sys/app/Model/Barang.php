<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    //
    
    protected $table = 'm_barang';

    protected $primaryKey = 'id_barang';

    public $timestamps = false;

    protected $fillable = [
        'id_barang', 'kode_barang', 'nama_barang', 'harga_jual', 'harga_beli', 'satuan', 'is_delete', 'input_by', 'input_date', 'update_by', 'update_date', 'delete_by', 'delete_date'
    ];
    
}
