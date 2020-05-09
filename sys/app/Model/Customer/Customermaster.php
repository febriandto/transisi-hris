<?php

namespace App\Model\Customer;
use Eloquent;

use Illuminate\Database\Eloquent\Model;

class Customermaster extends Model
{
    protected $table = 	'wms_m_customer';

    protected $primaryKey = 'cust_id';

    protected $keyType = 'string';

    public $timestamps = false;

    protected $guarded = ['cust_id'];
}
