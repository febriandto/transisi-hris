<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PaStaff extends Model
{
    //
    
    protected $table = 'hris_pa_staff';

    protected $primaryKey = 'id_pa_staff';

    public $timestamps = false;

    protected $fillable = ['id_pa_staff','ps_periode','id_emp','q1_score','q1_rmk','q2_score','q2_rmk','q3_score','q3_rmk','q4_score','q4_rmk','input_date','input_by','is_delete'];
}
