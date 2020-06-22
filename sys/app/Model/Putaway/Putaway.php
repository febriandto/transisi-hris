<?php

namespace App\Model\Putaway;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

class Putaway extends Model
{
		protected $table      = 'wms_t_putaway';
		
		protected $primaryKey = 'putaway_no';
		
		protected $keyType    = 'string';
		
		public $timestamps    = false;
		
		protected $guarded    = [];
}
