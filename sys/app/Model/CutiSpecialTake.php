<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CutiSpecialTake extends Model
{
    //
    
    protected $table = 'hris_t_cuti_special_take';

    protected $primaryKey = 'cuti_special_take_id';

    public $timestamps = false;

    protected $fillable = ['cuti_special_take_id', 'id_cuti_special', 'cuti_special_use_qty',    'cuti_special_status', 'input_by',    'input_date',  'edit_by', 'edit_date',   'is_delete'];
}
