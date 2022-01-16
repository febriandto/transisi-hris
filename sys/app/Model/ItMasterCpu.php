<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ItMasterCpu extends Model
{
    //
    
    protected $table = 'hris_it_m_cpu';

    protected $primaryKey = 'cpu_id';

    public $timestamps = false;

    protected $fillable = [ 'cpu_id','cpu_brand','cpu_type','cpu_speed','cpu_remark','input_by','input_date','edit_by','edit_date','is_delete'];
    
}
