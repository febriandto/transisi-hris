<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PaOp extends Model
{
    //
    
    protected $table = 'hris_pa_op';

    protected $primaryKey = 'id_pa_op';

    public $timestamps = false;

    protected $fillable = ['id_pa_op','po_periode','id_emp','jan_score','jan_rmk','feb_score','feb_rmk','mar_score','mar_rmk','apr_score','apr_rmk','may_score','may_rmk','jun_score','jun_rmk','jul_score','jul_rmk','aug_score','aug_rmk','sep_score','sep_rmk','oct_score','oct_rmk','nop_score','nop_rmk','dec_score','dec_rmk','input_date','input_by','is_delete'];
}
