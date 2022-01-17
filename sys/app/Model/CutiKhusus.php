<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CutiKhusus extends Model
{
    //
    
    protected $table = 'hris_t_cuti_khusus';

    protected $primaryKey = 'cuti_khusus_id';

    public $timestamps = false;

    protected $fillable = ['cuti_khusus_id',   'id_emp',  'cuti_k_cat_id',   'cuti_k_periode',  'input_by',    'input_date',  'is_delete'];
}
