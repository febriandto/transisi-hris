<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CutiUsage extends Model
{
    //
    
    protected $table = 'hris_cuti_usage';

    protected $primaryKey = 'cuti_usage_id';

    public $timestamps = false;

    protected $fillable = ['cuti_usage_id',  'emp_id',  'start_date',  'end_date',    'cuti_take',   'remarks', 'cuti_usage_status',   'input_by',    'input_date',  'edit_by', 'edit_date',   'is_delete'];
    
}
