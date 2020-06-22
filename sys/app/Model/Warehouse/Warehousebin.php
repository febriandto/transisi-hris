<?php

namespace App\Model\Warehouse;

use Illuminate\Database\Eloquent\Model;

class Warehousebin extends Model
{
    protected $table = 	'wms_m_bin';

    protected $primaryKey = 'bin_loc_id';
    
    protected $keyType = 'string';
    
    public $timestamps = false;

    protected $guarded = ['bin_loc_id'];
}
