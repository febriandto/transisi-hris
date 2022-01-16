<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    //
    
    protected $table = 'hris_contract';

    protected $primaryKey = 'no_contract';

    public $timestamps = false;

    protected $fillable = [ 'no_contract','id_emp','contract_status','contract_start_date','contract_end_date','remarks','input_by','input_date','update_by','update_date','is_delete'];
    
}
