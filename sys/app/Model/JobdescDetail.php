<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class JobdescDetail extends Model
{
    //
    
    protected $table = 'hris_jobdesc_detail';

    protected $primaryKey = 'id_jobdesc_detail';

    public $timestamps = false;

    protected $fillable = [ 'id_jobdesc_detail','id_jobdesc','jobdesc_detail_desc','input_date','input_by','is_delete'];
    
}
