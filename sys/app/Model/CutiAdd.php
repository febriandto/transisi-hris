<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CutiAdd extends Model
{
    //
    
    protected $table = 'hris_t_cuti_add';

    protected $primaryKey = 'cuti_add_id';

    public $timestamps = false;

    protected $fillable = ['cuti_add_id',  'cuti_id', 'cuti_add_hr', 'cuti_add_qty',    'cuti_add_date',   'cuti_add_remarks',    'cuti_add_cat',    'input_by',    'input_date',  'edit_by', 'edit_date',   'is_delete'   ];
}
