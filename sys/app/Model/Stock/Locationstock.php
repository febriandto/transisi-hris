<?php

namespace App\Model\Stock;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

class Locationstock extends Model
{
		protected $table      = 'wms_t_location_stock';
		
		protected $primaryKey = 'onbound_id';
		
		protected $keyType    = 'string';
		
		public $timestamps    = false;
		
		protected $guarded    = [];
}
