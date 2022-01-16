<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MasterBpjs extends Model
{
    //
    
    protected $table = 'hris_m_bpjs';

    protected $primaryKey = 'id_bpjs';

    public $timestamps = false;

    protected $fillable = ['id_bpjs','id_bpjs_cat','id_emp','id_card_no','bpjs_joindate','bpjs_status','input_by','input_date','edit_by','edit_date','is_delete'];
    
}
