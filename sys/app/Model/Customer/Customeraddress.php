<?php

namespace App\Model\Customer;
use Eloquent;

use Illuminate\Database\Eloquent\Model;

class Customeraddress extends Model
{
    protected $table = 	'wms_m_customer_add';

    protected $primaryKey = 'cust_add_id';

    protected $keyType = 'string';

    public $timestamps = false;

    protected $guarded = ['cust_add_id'];
}
