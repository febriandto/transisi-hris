<?php

namespace App\Model\Tally;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

class TallyDetail extends Model
{
		protected $table      = 'wms_t_tally_detail';
		
		protected $primaryKey = 'tally_detail_id';
		
		protected $keyType    = 'string';
		
		public $timestamps    = false;
		
		protected $guarded    = ['tally_detail_id'];
}
