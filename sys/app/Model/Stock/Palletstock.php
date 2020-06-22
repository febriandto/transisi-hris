<?php

namespace App\Model\Stock;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

class Palletstock extends Model
{
		protected $table      = 'wms_t_pallet_stock';
		
		protected $primaryKey = 'inbound_id';
		
		protected $keyType    = 'string';
		
		public $timestamps    = false;
		
		protected $guarded    = [];
}
