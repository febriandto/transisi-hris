<?php

namespace App\Model\Warehouse;
use Eloquent;

use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    protected $table = 	'wms_m_column';

    protected $primaryKey = 'col_id';

    protected $keyType = 'string';

    public $timestamps = false;

    protected $guarded = ['col_id'];
}
