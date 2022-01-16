<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MasterMutasi extends Model
{
    //
    
    protected $table = 'hris_m_mutasi';

    protected $primaryKey = 'id_mutasi';

    public $timestamps = false;

    protected $fillable = ['id_mutasi','id_emp','id_dept','mutasi_activedate','mutasi_category','input_by','input_date','is_delete'];
    
}
