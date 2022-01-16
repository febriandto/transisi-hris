<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ItSupportTs extends Model
{
    //
    
    protected $table = 'hris_it_ts';

    protected $primaryKey = 'id_ts';

    public $timestamps = false;

    protected $fillable = [ 'id_ts','ts_date','id_emp','ts_cat_id','ts_name','ts_problem','ts_solving','ts_hr','ts_min','ts_status','ts_remarks','input_by','input_time','edit_by','edit_time','is_delete'];
    
}
