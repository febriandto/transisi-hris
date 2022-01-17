<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CutiKhususDetail extends Model
{
    //
    
    protected $table = 'hris_t_cuti_khusus_detail';

    protected $primaryKey = 'cuti_khusus_detail_id';

    public $timestamps = false;

    protected $fillable = ['cuti_khusus_detail_id',    'cuti_khusus_id',  'cuti_k_date', 'input_by',    'input_date',  'is_delete'   ];
}
