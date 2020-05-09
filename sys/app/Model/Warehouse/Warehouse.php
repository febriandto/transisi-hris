<?php

namespace App\Model\Warehouse;
use Eloquent;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 	'wms_m_warehouse';

    protected $primaryKey = 'wh_id';
    protected $keyType = 'string';

    public $timestamps = false;

    protected $guarded = ['wh_id'];

    public function warehousezone()
    {
        return $this->hasMany('App\Model\Warehouse\Warehousezone');
    }

    public function warehouselocation()
    {
        return $this->hasMany('App\Model\Warehouse\Warehouselocation');
    }
    
}
