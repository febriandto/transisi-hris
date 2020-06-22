<?php

namespace App\Model\Picking;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

class Picking extends Model
{
		protected $table      = 'wms_t_picking';
		
		protected $primaryKey = 'picking_no';
		
		protected $keyType    = 'string';
		
		public $timestamps    = false;
		
		protected $guarded    = [];
}
