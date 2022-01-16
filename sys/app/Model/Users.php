<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{

 protected $table = 'hris_user';

 protected $primaryKey = 'id_user';

 public $timestamps = false;

 protected $fillable = ['id_user', 'username', 'password', 'name', 'level', 'status'];

 protected $guarded = ['id_user'];

}

