<?php

namespace App\Model\Warehouse;
use Eloquent;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $table = 	'wms_m_level';

    protected $primaryKey = 'level_id';

    public $timestamps = false;

    protected $guarded = ['level_id'];
}