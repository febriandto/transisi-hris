<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 	'wms_m_warehouse';

    protected $primaryKey = 'wh_id';
    protected $keyType = 'string';

    public $timestamps = false;

    protected $guarded = ['wh_id'];
}
