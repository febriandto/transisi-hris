<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MasterCutiSpecial extends Model
{
    //
    
    protected $table = 'hris_m_cuti_special';

    protected $primaryKey = 'id_cuti_special';

    public $timestamps = false;

    protected $fillable = ['id_cuti_special','id_emp','cuti_Special_cat','qty_cuti_special','qty_cuti_special_use','qty_cuti_special_active','cuti_special_valid_date','cuti_special_status','cuti_special_remarks','input_by','input_date','edit_by','edit_date'];
    
}
