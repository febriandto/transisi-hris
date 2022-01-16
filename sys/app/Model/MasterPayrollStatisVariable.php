<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MasterPayrollStatisVariable extends Model
{
    //
    
    protected $table = 'hris_m_payroll_statis_variable';

    protected $primaryKey = 'statis_variable_id';

    public $timestamps = false;

    protected $fillable = ['statis_variable_id',   'statis_variable_name',    'statis_variable_amount',  'statis_variable_alias',  'statis_variable_description', 'input_by',    'input_date',  'edit_by', 'edit_date',   'is_delete'];
    
}
