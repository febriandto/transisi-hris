<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CutiTakeDetail extends Model
{
    //
    
    protected $table = 'hris_cuti_take_detail';

    protected $primaryKey = 'id_leave_req';

    public $timestamps = false;

    protected $fillable = ['cuti_take_detail_id',  'cuti_take_id',   ' cuti_take_date'  ];
    
}
