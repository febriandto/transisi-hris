<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ItMasterMonitor extends Model
{
    //
    
    protected $table = 'hris_it_m_monitor';

    protected $primaryKey = 'monitor_id';

    public $timestamps = false;

    protected $fillable = ['monitor_id','monitor_brand','monitor_size','monitor_remark','input_by','input_date','edit_by','edit_date','is_delete'];
    
}
