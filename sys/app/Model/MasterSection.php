<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MasterSection extends Model
{
    //
    
    protected $table = 'hris_m_section';

    protected $primaryKey = 'id_section';

    public $timestamps = false;

    protected $fillable = [ 'id_section','section_name','id_dept','section_head','input_date','input_by','is_delete'];
}
