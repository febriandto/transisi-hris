<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MasterLeaveCategory extends Model
{
    //
    
    protected $table = 'hris_m_leave_category';

    protected $primaryKey = 'id_leave_cat';

    public $timestamps = false;

    protected $fillable = ['id_leave_cat','leave_cat_name','leave_cat_remark','input_by','input_date','edit_by','edit_date','is_delete'];
    
}
