<?php

namespace App\Model\Picking;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

class PickingDetail extends Model
{
		protected $table      = 'wms_t_picking_detail';
		
		protected $primaryKey = 'picking_detail_id';
		
		protected $keyType    = 'string';
		
		public $timestamps    = false;
		
		protected $guarded    = [];
}
