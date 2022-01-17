<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TCutiTakeDetail extends Model
{
    //
    
    protected $table = 'hris_t_cuti_take_detail';

    protected $primaryKey = 'cuti_take_detail_id';

    public $timestamps = false;

    protected $fillable = ['cuti_take_detail_id',  'cuti_take_id',    'tgl_cuti_take',   'qty_take',    'cuti_take_notes', 'cuti_take_status',    'input_by',    'input_date',  'edit_by', 'edit_date',   'is_delete'];
}
