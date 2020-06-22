<?php

namespace App\Model\Warehouse;

use Illuminate\Database\Eloquent\Model;

class Warehousename extends Model
{
		protected $table      = 	'wms_m_warehouse';
		
		protected $primaryKey = 'wh_id';
		
		protected $keyType    = 'string';
		
		public $timestamps    = false;
		
		protected $guarded    = ['wh_id'];
}
