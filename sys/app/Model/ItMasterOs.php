<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ItMasterOs extends Model
{
    //
    
    protected $table = 'hris_it_m_os';

    protected $primaryKey = 'os_id';

    public $timestamps = false;

    protected $fillable = ['os_id','os_brand','os_name','os_arsitektur','os_remark','input_by','input_date','edit_by','edit_date','is_delete'];
    
}
