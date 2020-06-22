<?php

namespace App\Model\Uom;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

class Uom extends Model
{
		protected $table      = 'wms_m_uom';
		
		protected $primaryKey = 'uom_id';
		
		protected $keyType    = 'string';
		
		public $timestamps    = false;
		
		protected $guarded    = [];
}
