<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MasterDepartment extends Model
{
    //
    
    protected $table = 'hris_m_dept';

    protected $primaryKey = 'id_dept';

    public $timestamps = false;

    protected $fillable = ['id_dept','dept_name','dept_head','dept_parent','is_delete'];
    
}
