<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TCutiTake extends Model
{
    //
    
    protected $table = 'hris_t_cuti_take';

    protected $primaryKey = 'cuti_take_id';

    public $timestamps = false;

    protected $fillable = ['cuti_take_id', 'cuti_id', 'cuti_use_qty', 'cuti_use_desc', 'status',  'input_by', 'input_date', 'edit_by', 'edit_date', 'is_delete'];
}
