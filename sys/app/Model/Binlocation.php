<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Binlocation extends Model
{
    protected $table = 	'wms_m_bin';

    protected $primaryKey = 'bin_loc_id';
    protected $keyType = 'string';

    public $timestamps = false;

    protected $guarded = ['bin_loc_id'];
}
