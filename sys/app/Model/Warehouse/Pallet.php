<?php

namespace App\Model\Warehouse;
use Eloquent;

use Illuminate\Database\Eloquent\Model;

class Pallet extends Model
{
    protected $table = 	'wms_m_pallet';

    protected $primaryKey = 'pallet_id';

    protected $keyType = 'string';

    public $timestamps = false;

    protected $guarded = ['pallet_id'];
}
