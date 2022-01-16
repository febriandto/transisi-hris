<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MasterCuti extends Model
{
    //
    
    protected $table = 'hris_m_cuti';

    protected $primaryKey = 'cuti_id';

    public $timestamps = false;

    protected $fillable = ['cuti_id','id_emp','cuti_periode','cuti_qty','cuti_valid_till','cuti_active','cuti_taken','cuti_status','input_by','input_date','edit_by','edit_date','is_delete'];
    
}
