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
        
}
