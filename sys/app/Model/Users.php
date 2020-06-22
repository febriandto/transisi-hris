<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{

 protected $table = 'wms_m_user';

 protected $primaryKey = 'id_user';

 public $timestamps = false;

 protected $guarded = ['id_user'];

}

