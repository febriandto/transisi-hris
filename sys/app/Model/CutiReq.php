<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CutiReq extends Model
{
    //
    
    protected $table = 'hris_cuti_req';

    protected $primaryKey = 'id_leave_req';

    public $timestamps = false;

    protected $fillable = [ 'id_leave_req', 'id_cuti', 'qty_req', 'start_date',  'end_date', 'appr1', 'appr1_date', 'appr2', 'appr2_date',  'input_by',    'input_date',  'update_by',   'update_date', 'is_delete' ];
    
}
