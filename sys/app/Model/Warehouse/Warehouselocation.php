<?php

namespace App\Model\Warehouse;
use Eloquent;

use Illuminate\Database\Eloquent\Model;

class Warehouselocation extends Model
{
    protected $table = 	'wms_m_location';

    protected $primaryKey = 'location_id';
    
    protected $keyType = 'string';

    public $timestamps = false;

    protected $guarded = ['location_id'];

    public function warehouse()
    {
        return $this->belongsTo('App\Model\Warehouse\Warehouse', 'wh_id');
    }

    public function warehousezone()
    {
        return $this->belongsTo('App\Model\Warehouse\Warehousezone', 'wh_zone_id');
    }

    public function warehouserow()
    {
        return $this->belongsTo('App\Model\Warehouse\Warehouserow', 'wh_row_id');
    }

    public function warehousearea()
    {
        return $this->belongsTo('App\Model\Warehouse\Warehousearea', 'wh_area_id');
    }

    public function warehouseplant()
    {
        return $this->belongsTo('App\Model\Warehouse\Warehouseplant', 'plant_id');
    }
        
}
