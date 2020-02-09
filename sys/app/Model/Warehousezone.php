<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Warehousezone extends Model
{

    protected $table = 	'wms_m_warehouse_zone';

    protected $primaryKey = 'wh_zone_id';
    protected $keyType = 'string';

    public $timestamps = false;

    protected $guarded = ['wh_zone_id'];
    
}
