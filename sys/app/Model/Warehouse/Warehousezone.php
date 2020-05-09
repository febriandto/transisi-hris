<?php

namespace App\Model\Warehouse;

use Illuminate\Database\Eloquent\Model;

class Warehousezone extends Model
{

    protected $table = 	'wms_m_warehouse_zone';

    protected $primaryKey = 'wh_zone_id';
    protected $keyType = 'string';

    public $timestamps = false;

    protected $guarded = ['wh_zone_id'];

    public function warehouse()
    {
        return $this->belongsTo('App\Model\Warehouse\Warehouse', 'wh_id');
    }

    public function warehousearea()
    {
        return $this->hasMany('App\Model\Warehouse\Warehousearea');
    }

    public function warehouselocation()
    {
        return $this->hasMany('App\Model\Warehouse\Warehouselocation');
    }
    
}
