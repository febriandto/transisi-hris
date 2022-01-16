<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MasterPayrollDinamicVariable extends Model
{
    //
    
    protected $table = 'hris_m_payroll_dinamic_variable';

    protected $primaryKey = 'dinamic_variable_id';

    public $timestamps = false;

    protected $fillable = ['dinamic_variable_id',  'id_emp',  'dinamic_variable_name',   'dinamic_variable_amount', 'dinamic_variable_alias',  'dinamic_variable_desc',   'input_by',    'input_date',  'edit_by', 'edit_date',   'is_delete'   ];
    
}
