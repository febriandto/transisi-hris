<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Accident extends Model
{
    //
    
    protected $table = 'hris_accident';

    protected $primaryKey = 'id_accident';

    public $timestamps = false;

    protected $keyType = 'string';

    protected $fillable = ['id_accident', 'acc_date', 'acc_time', 'acc_condition', 'id_acc_cat', 'id_emp', 'acc_desc', 'acc_recovery_desc', 'acc_status', 'input_by', 'input_date', 'edit_by', 'edit_date', 'is_delete'];
    
}
