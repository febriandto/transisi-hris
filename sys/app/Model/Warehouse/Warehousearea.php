<?php

namespace App\Model\Warehouse;

use Illuminate\Database\Eloquent\Model;

class Warehousearea extends Model
{
    protected $table = 	'wms_m_area';

    protected $primaryKey = 'wh_area_id';
    
    protected $keyType = 'string';

    public $timestamps = false;

    protected $guarded = ['wh_area_id'];

    public function warehousezone()
    {
        return $this->belongsTo('App\Model\Warehouse\Warehousezone', 'wh_zone_id');
    }

    public function warehouserow(){

        return $this->hasMany('App\Model\Warehouse\Warehouserow');
    }

    public function warehouselocation()
    {
        return $this->hasMany('App\Model\Warehouse\Warehouselocation');
    }

}
