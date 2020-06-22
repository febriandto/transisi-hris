<?php

namespace App\Model\Putaway;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

class PutawayDetail extends Model
{
		protected $table      = 'wms_t_putaway_detail';
		
		protected $primaryKey = 'putaway_detail_id';
		
		protected $keyType    = 'string';
		
		public $timestamps    = false;
		
		protected $guarded    = ['putaway_detail_id'];
}
