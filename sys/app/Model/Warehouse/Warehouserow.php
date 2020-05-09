<?php

namespace App\Model\Warehouse;

use Illuminate\Database\Eloquent\Model;

class Warehouserow extends Model
{
    protected $table = 	'wms_m_row';

    protected $primaryKey = 'wh_row_id';
    // diubah menjadi varchar
    protected $keyType = 'string';

    public $timestamps = false;

    protected $guarded = ['wh_row_id'];

    public function warehousearea(){

        return $this->belongsTo('App\Model\Warehouse\Warehousearea', 'wh_area_id');
    }

    public function warehousebin()
    {
        return $this->hasMany('App\Model\Warehouse\Warehousebin');
    }

    public function warehouselocation()
    {
        return $this->hasMany('App\Model\Warehouse\Warehouselocation');
    }
}