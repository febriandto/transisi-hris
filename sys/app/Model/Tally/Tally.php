<?php

namespace App\Model\Tally;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

class Tally extends Model
{
		protected $table      = 'wms_t_tally';
		
		protected $primaryKey = 'tally_no';
		
		protected $keyType    = 'string';
		
		public $timestamps    = false;
		
		protected $guarded    = [];
}
