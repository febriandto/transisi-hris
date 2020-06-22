<?php

namespace App\Model\Loading;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

class LoadingDetail extends Model
{
		protected $table      = 'wms_t_loading_detail';
		
		protected $primaryKey = 'loading_detail_id';
		
		protected $keyType    = 'string';
		
		public $timestamps    = false;
		
		protected $guarded    = [];
}
