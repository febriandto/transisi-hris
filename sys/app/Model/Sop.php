<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sop extends Model
{
    //
    
    protected $table = 'hris_sop';

    protected $primaryKey = 'id_sop';

    public $timestamps = false;

    protected $fillable = ['id_sop','sop_number','sop_title','id_section','id_dept','sop_detail','start_date','valid_date','sop_status','input_by','input_date','edit_by','edit_date','is_delete'];
}
