<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MasterSubSection extends Model
{
    //
    
    protected $table = 'hris_m_subsection';

    protected $primaryKey = 'id_sub_section';

    public $timestamps = false;

    protected $fillable = ['id_sub_section','subsection_name','id_section','input_by','input_date','is_delete'];
}
