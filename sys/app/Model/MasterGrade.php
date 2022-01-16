<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MasterGrade extends Model
{
    //
    
    protected $table = 'hris_m_grade';

    protected $primaryKey = 'id_grade';

    public $timestamps = false;

    protected $fillable = ['id_grade','grade_name','grade_remarks','grade_level','id_dept','is_delet'];
    
}
