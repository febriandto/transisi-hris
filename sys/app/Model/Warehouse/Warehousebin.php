<?php

namespace App\Model\Warehouse;

use Illuminate\Database\Eloquent\Model;

class Warehousebin extends Model
{
    protected $table = 	'wms_m_bin';

    protected $primaryKey = 'wh_bin_id';
    
    protected $keyType = 'string';
    
    public $timestamps = false;

    protected $guarded = ['wh_bin_id'];

    public function warehouserow()
    {
        return $this->belongsTo('App\Model\Warehouse\Warehouserow', 'wh_row_id');
    }
}
