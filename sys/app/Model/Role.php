<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    
    protected $table = 'hris_role';

    protected $primaryKey = 'role_id';

    public $timestamps = false;

    protected $fillable = ['role_id','role_title','role_desc','role_active_date','role_exp_date','role_status','input_by','input_date','edit_by','edit_date','is_delete'];
}
