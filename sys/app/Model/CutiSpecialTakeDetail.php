<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CutiSpecialTakeDetail extends Model
{
    //
    
    protected $table = 'hris_t_cuti_special_take_detail';

    protected $primaryKey = 'cuti_special_take_detail_id';

    public $timestamps = false;

    protected $fillable = ['cuti_special_take_detail_id',  'cuti_special_take_id',    'tgl_cuti_special_take',   'qty_cuti_special_take',   'cuti_special_take_notes', 'cuti_special_take_status',    'input_by',    'input_date',  'is_delete'];
}
