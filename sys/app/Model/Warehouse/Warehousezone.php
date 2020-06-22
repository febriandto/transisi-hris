<?php

namespace App\Model\Warehouse;

use Illuminate\Database\Eloquent\Model;

class Warehousezone extends Model
{

    protected $table      = 'wms_m_zone';
    
    protected $primaryKey = 'zone_id';
    
    protected $keyType    = 'string';
    
    public $timestamps    = false;
    
    protected $guarded    = ['zone_id'];
    
}
