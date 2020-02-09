<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Warehouserow extends Model
{
    protected $table = 	'wms_m_row';

    protected $primaryKey = 'wh_row_id';
    // diubah menjadi varchar
    protected $keyType = 'string';

    public $timestamps = false;

    protected $guarded = ['wh_row_id'];
}