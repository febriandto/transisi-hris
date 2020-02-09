<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Warehousearea extends Model
{
    protected $table = 	'wms_m_area';

    protected $primaryKey = 'wh_area_id';
    // diubah menjadi varchar
    protected $keyType = 'string';

    public $timestamps = false;

    protected $guarded = ['wh_area_id'];
}
