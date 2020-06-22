<?php

namespace App\Model\Loading;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

class Loading extends Model
{
		protected $table      = 'wms_t_loading';
		
		protected $primaryKey = 'loading_no';
		
		protected $keyType    = 'string';
		
		public $timestamps    = false;
		
		protected $guarded    = [];
}
