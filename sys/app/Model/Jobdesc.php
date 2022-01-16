<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Jobdesc extends Model
{
    //
    
    protected $table = 'hris_jobdesc';

    protected $primaryKey = 'id_jobdesc';

    public $timestamps = false;

    protected $fillable = ['id_jobdesc','id_grade','jobdesc_name','jobdesc_description','input_date','input_by','is_delete'];
    
}
