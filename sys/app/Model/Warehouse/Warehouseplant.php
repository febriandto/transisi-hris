<?php

namespace App\Model\Warehouse;
use Eloquent;

use Illuminate\Database\Eloquent\Model;

class Warehouseplant extends Model
{
    protected $table = 	'wms_m_plant';

    protected $primaryKey = 'plant_id';

    protected $keyType = 'string';

    protected $guarded = ['plant_id'];

    public $timestamps = false;

    public function warehouselocation()
    {
        return $this->hasMany('App\Model\Warehouse\Warehouselocation');
    }
    
}
