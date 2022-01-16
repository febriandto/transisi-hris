<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LeaveReq extends Model
{
    //
    
    protected $table = 'hris_leave_req';

    protected $primaryKey = 'id_leave_req';

    public $timestamps = false;

    protected $fillable = ['id_leave_req','id_leave_cat','id_emp','leave_req_time','leave_req_date','leave_req_file','leave_req_desc','leave_status','input_by','input_date','edit_by','edit_date','is_delete'];
    
}
